<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Education extends Model
{
    use HasFactory;
    
    public $table = "educations";
    public $guarded = [];

    public $hidden =['created_at', 'updated_at'];


    public static  function createVideosTable($fetched_data, $type, $is_playlist = false) {

        if (!$is_playlist)
        {
            $current = $fetched_data['current_page'];
            $data = $fetched_data['data'];
            $links = $fetched_data['links'];
            $next_page = $fetched_data['next_page_url'];
            $prev_page = $fetched_data['prev_page_url'];
            $per_page = $fetched_data['per_page'];
            $last_page = $fetched_data['last_page'];
            $total_count = $fetched_data['total'];
            $page_count = ceil($total_count / $per_page);

            $div = "<div class='row'>";
            if (count($data) > 0) {
                foreach($data as $education) {
                    try {
                        $url = explode("](", $education['url']);
                        $title = ltrim($url[0], '[');
                        
                        if (isset($url[1])) {
                            $link = rtrim($url[1], ')');
                            $link = str_replace('"', "", $link);
                            $ytlink = explode("embed/", $url[1]);
                            $ytlinkid = explode("?si=", $ytlink[1]);
                            $yt = $ytlink[0]."watch?v=".$ytlinkid[0];
                            $thumbnail = "https://img.youtube.com/vi/".$ytlinkid[0]."/hqdefault.jpg";
                            $watch_link = $ytlink[0] ."embed/". $ytlinkid[0] . "?autoplay=1&mute=0&enablejsapi=1";
                            $div .= "<div class='col-sm-4 div-video'>
                                <div class='card mb-4'>
                                    <div class='card-header card-outline card-primary'>
                                        <medium class='d-inline-block text-truncate' style='max-width: 80%;'>".$title."</medium>
                                        
                                        <div class='card-tools'>
                                            <button type='button' class='btn btn-outline-success btn-sm daterange' title='Copy Share Link'
                                                data-share='".url("/education/shared/".$education['id'])."'
                                            >
                                                <i class='fa fa-share'></i> Share
                                            </button>
                                        </div>
                                    </div>
                                    <div class='card-body p-1'>
                                        <img src='".$thumbnail."' alt='' class='img-fluid'>
                                    </div>

                                    <div class='card-footer p-1'>
                                        <button class='btn btn-block btn-sm btn-outline-danger btn-iframe' 
                                            data-link='".addslashes($watch_link)."'
                                            data-share='".url("/education/shared/".$education['id'])."'>
                                            <i class='fab fa-youtube'></i> Play
                                        </button>
                                                                            
                                    </div> 
                                </div>
                            </div>";
                        }
                    } catch(Exception) { }
                }
            }
            $div .= "</div>";
            $data_append = $type == "fetch" ? 
                "$('.div-table-data').html(\"".preg_replace('/\s+/', ' ', $div)."\");" : 
                "$('.div-table-data').append(\"".preg_replace('/\s+/', ' ', $div)."\");";
                
            return 
                $data_append.
            "
                $('#pageno').val(".$current.");
                $('#page_total').val(".$page_count.");            
            _execWidget(); 
            
            ";
        } else {
            $auto_play = "";
            $data = $fetched_data;
            $education_id = "";
            $history = PlaylistHistory::where('user_id', Auth::id())->get();

            if ($history && count($history) > 0) {
                $education_id = $history[0]->education_id;
            }
            
            $div = "<div class='row'>
                <div class='col-md-8'>
                    <div class= 'div-playlist-body' >
                        <iframe id ='iframe-player' class='w-100 iframe' src='' allow='autoplay;' frameborder='0' allowfullscreen></iframe>
                    </div>
                </div>
                <div class='col-md-4 div-playlist bg-white pt-2'>
                    <div class='d-flex justify-content-between'>
                        <h4 class='mb-2'> ".count($data)." Videos </h4>
                        <a href='javascript:void(0)' id='play-all'> Play All </a>
                    </div>

                    <ul id='ul-playlist'   class='products-list product-list-in-card pl-2 pr-2'>
            ";
            if (count($data) > 0) {
                foreach($data as $education) {
                    try {
                        $url = explode("](", $education['url']);
                        $title = ltrim($url[0], '[');
                        
                        if (isset($url[1])) {
                            $link = rtrim($url[1], ')');
                            $link = str_replace('"', "", $link);
                            $ytlink = explode("embed/", $url[1]);
                            $ytlinkid = explode("?si=", $ytlink[1]);
                            $yt = $ytlink[0]."watch?v=".$ytlinkid[0];
                            $thumbnail = "https://img.youtube.com/vi/".$ytlinkid[0]."/hqdefault.jpg";

                            $watch_link = $ytlink[0] ."embed/". $ytlinkid[0] . "?autoplay=1&mute=0&enablejsapi=1";
                            $div .= "
                                <li class='item pl-2'>
                                    <div class='product-img'>
                                        <img src='".$thumbnail."' alt='' class=''>
                                    </div>
                                    <div class='product-info' id='educ_".$education['id']."'>
                                        <a href='javascript:void(0)' class='btn-playlist' data-id='".$education['id']."' data-link='".addslashes($watch_link)."'>".addslashes($title)." </a>
                                    </div>
                                </li>";

                            if (!empty($education_id) && $education_id === $education['id']) {
                                $auto_play = "
                                    $('[data-id=".$education['id']."]').click();
                                    document.getElementById('educ_".$education['id']."').scrollIntoView();
                                ";
                            }
                        }
                    } catch(Exception) { }
                }
            }
            $div .= "</ul></div>";
                
            return "
                $('.div-table-data').html(\"".preg_replace('/\s+/', ' ', $div)."\");
                _execWidget();
                ".$auto_play."
            ";            
        }
    }
}