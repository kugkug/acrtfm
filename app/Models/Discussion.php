<?php

namespace App\Models;

use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Discussion extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];

    protected $cast = [
        "created_at" => "datetime:Y-m-d H:00"
    ];

    public static function createDiscussionTable($posts, $type = "fetch") {
        try {
            $discussions = self::formatDiscussions($posts);

            $current = $discussions['current_page'];
            $data = $discussions['data'];
            $links = $discussions['links'];
            $next_page = $discussions['next_page_url'];
            $prev_page = $discussions['prev_page_url'];
            $per_page = $discussions['per_page'];
            $last_page = $discussions['last_page'];
            $total_count = $discussions['total'];
            $page_count = ceil($total_count / $per_page);
            
            $current_user = Auth::user();
            $is_admin = $current_user->user_type == "admin";
            
            $card = "";
            
            // <span class='img-circle'>
            //     <img class='img-circle img-sm' 
            //         src='https://media.istockphoto.com/id/1495088043/vector/user-profile-icon-avatar-or-person-icon-profile-picture-portrait-symbol-default-portrait.jpg?s=612x612&w=0&k=20&c=dhV2p1JwmloBTOaGAtaA3AW1KSnjsdMt7-U_3EZElZ0=' 
            //         alt='User Image'>
            // </span>

            foreach($data as $post)
            {
                $card_tools = "";
                if ($is_admin) {
                    $card_tools = "
                            <button type='button' class='btn btn-tool text-success' title='Edit'>
                                <i class='far fa-edit'></i>
                            </button>
                            <button type='button' class='btn btn-tool text-warning' title='Close'>
                                <i class='fas fa-comment-slash'></i>
                            </button>
                            <button type='button' class='btn btn-tool text-danger' title='Delete'>
                                <i class='fas fa-trash'></i>
                            </button>
                    ";
                } else if ($post['is_own_post']) {
                    $card_tools = "
                            <button type='button' class='btn btn-tool' title='Close'>
                                <i class='fas fa-times'></i>
                            </button>";
                }
                    
                $card .= "<div class='card card-widget'>
                            <div class='card-header'>
                                <div class='user-block'>
                                    <span class='username' style='margin-left: 0px !important'>".ucwords(strtolower($post['user_info']['name'])) ."</span>
                                    <span class='description' style='margin-left: 0px !important'>".Carbon::parse($post['created_at'])->format("Y-m-d H:ia")."</span>
                                </div>
                                <div class='card-tools'>";
                                
                $card .= $card_tools;
                
                $card .="</div></div>";
                                    
                $comment_count = count($post['comments']) > 1 ? 
                " Comments " . count($post['comments']):
                " Comment " . count($post['comments']);

                $card .="   <div class='card-body'>
                                <p>".$post['post']."</p>
                        
                                <p>
                                    <span class='float-right'>
                                        <a href='#' class='link-black text-sm mr-2'><i class='fas fa-share mr-1'></i> Share</a>
                                    </span>
                
                                    <span class='text-muted'> <i class='far fa-comments mr-1'></i> ".$comment_count." </span>
                                </p>
                            </div>
                            
                            <div class='card-footer card-comments'>";

                // <img class='img-circle img-sm' src='https://media.istockphoto.com/id/1495088043/vector/user-profile-icon-avatar-or-person-icon-profile-picture-portrait-symbol-default-portrait.jpg?s=612x612&w=0&k=20&c=dhV2p1JwmloBTOaGAtaA3AW1KSnjsdMt7-U_3EZElZ0=' alt='User Image'>
                            foreach($post['comments'] as $comment) 
                            {
                $card .=        "<div class='card-comment'>
                                    
                                    <div class='comment-text' style='margin-left: 0px !important'>
                                        <span class='username' >
                                            ".ucwords( strtolower($comment['commentor']['name']) )."
                                            
                                            <span class='text-muted float-right'>".$comment['created_at']."</span>
                                            
                                        </span>
                                        ".trim($comment['comment'])."
                                        

                                        <div class='row mt-3'>
                                            <div class='col-md-12'>
                                ";
                                        if ($post['is_own_post'] && !$comment['is_own_comment'] ) 
                                        {
                $card .=                    "<div class='rating'>";
                                            for ($x = 5; $x >= 1; $x--) {
                                                $color = $comment['rate'] >= $x ? "#ffcc00" : "#dddddd";
                                                $card .= "
                                                    <input type='radio' name='rating' id='star".$x."_".$comment['id']."' value='".$x."'>
                                                    <label for='star".$x."_".$comment['id']."' title='".$x." stars' style='color: ".$color." !important'>&#9733;</label>
                                                ";
                                            }
                $card .=                    "</div>";
            
                                        } else {
                                            $color = $comment['rate'] > 0 ? "#ffcc00" : "#dddddd"; 
                $card .=                        "<i class='far fa-star' style='color: ".$color." !important'></i> ".$comment['rate'];                                            
                                        }
            

                                        if ($comment['is_own_comment']) {
                $card .=                    "<div class='float-right'>
                                                <a href='/execute/client/delete-comment?comment_id=".$comment['id']."' class='text-danger'>
                                                <i class='far fa-trash-alt'></i></a>
                                            </div>";
                                        }
                $card .= "                  </div>
                                        </div>
                                    </div>
                                </div>
                                ";
                }
                $card .= "</div></div>
                                ";

        }
        $data_append = $type == "fetch" ?
            "$('.div-table-data').html(\"".preg_replace('/\s+/', ' ', $card)."\");" :
            "$('.div-table-data').append(\"".preg_replace('/\s+/', ' ', $card)."\");";

        return
            $data_append.
            "
                $('#pageno').val(".$current.");
                $('#page_total').val(".$page_count.");
                _execWidget();

            ";
            
        
    } catch(Exception $e) {
        return ['user_info' => [], 'comments' => []];
    }
}

private static function formatDiscussions($posts) {

    $posts->getCollection()->transform(function ($post) {
        $user_info = User::where('id', $post['user_id'])->get();
        $comments = Comment::where("discussion_id", $post['id'])
        ->with('commentor')
        ->get()->toArray();

        $comments = array_map(function($comment) {
        $rates = Ratings::where('comment_id', $comment['id'])->get()->first();

        $comment['rate'] = $rates ? $rates->rate : 0;

        $comment['is_own_comment'] = $comment['user_id'] === Auth::id();
        $comment['created_at'] = Carbon::parse($comment['created_at'])->format("Y-m-d H:00 A");
            return $comment;
        }, $comments);

        $post['is_own_post'] = $post['user_id'] === Auth::id();
        $post['user_info'] = $user_info[0];
        $post['comments'] = $comments;

        return $post;
    });

    return $posts->toArray();
    }
}