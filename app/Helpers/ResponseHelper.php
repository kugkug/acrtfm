<?php

declare(strict_types=1);
namespace App\Helpers;

class ResponseHelper {
    const DESCRIPTION_MAX_LENGTH = 50;

    public function toastrResponse(string $message, string $type = 'error', string $title = 'System Error'): array {
        return [
            'js' => "_show_toastr('".$type."', '".$message."', '".$title."');"
        ];
    }

    public function scriptResponse(
        string $exec, 
        array $data, 
        string $message='', 
        string $toast_type = 'success', 
        string $title = 'System Info',
        bool $redirect = false
    ): array {

        $script = '';
        switch ($exec) {    
            case 'login':
                $script = "window.location.href = '".route('home')."';";
                break;
            case 'logout':
                $script = "window.location.href = '".route('login')."';";
                break;
            case 'model-lookup':
                $script = sizeof($data) == 0 ? '$(".div-result").html("No data found");' : 
                    '$(".div-result").html("'.preg_replace('/\s+/', ' ', $this->modelLookup($data)).'"); ';
                break; 
            case 'education':
                if (sizeof($data) == 0) {
                    $script = '$(".div-result").html("No data found");';
                } else {
                    $script = '
                    $(".div-result").html("'.preg_replace('/\s+/', ' ', $this->education($data)['html']).'"); 
                    $("#pageno").val("'.$this->education($data)['pageno'].'");
                    $("#page_total").val("'.$this->education($data)['page_total'].'");
                    $("#next_page").val("'.$this->education($data)['next_page'].'");
                    _init_actions();
                    ';
                }
                break;
            case 'education-paginate':
                    $script = '
                    $(".div-result").append("'.preg_replace('/\s+/', ' ', $this->education($data)['html']).'"); 
                    $("#pageno").val("'.$this->education($data)['pageno'].'");
                    $("#next_page").val("'.$this->education($data)['next_page'].'");
                    _init_actions();
                    ';
                break;
            case 'education-playlist':
                $script = '
                $(".div-result").html("'.preg_replace('/\s+/', ' ', $this->education_playlist($data)['html']).'"); 
                _init_actions();
                ';
                break;
            case 'job-sites-fetched':
                $script = sizeof($data) == 0 ? '$("#job-sites-list").html("<div class=\"mx-3 alert alert-danger w-100\" role=\"alert\">No data found</div>");' : 
                    '$("#job-sites-list").html("'.preg_replace('/\s+/', ' ', $this->job_sites_list($data)).'"); _init_actions();';
                break;
            case 'job-sites-saved':
                $script = "location = '".route('job-sites')."';";
                break;
            case 'job-sites-added':
                $script = "location = '".route('job-sites-areas', $data['id'])."';";
                break;
            case 'job-sites-deleted':
                $script = "location = '".route('job-sites')."';";
                break;
            case 'job-site-area-deleted':
                $script = "location = '".route('job-sites-areas', $data['id'])."';";
                break;
            case 'job-site-document-deleted':
            case 'job-site-image-deleted':
            case 'job-site-area-updated':
            case 'job-site-updated':
            case 'accomplishment-updated':
                $script = "location.reload();";
                break;
            case 'accomplishment-deleted':
                $script = "location = '".route('job-site-area-view', $data['job_area_id'])."';";
                break;
            
        }

        return ['js' => $script];
    }

    private function modelLookup(array $data): string {
        $table = "<table class='table table-hover'>
                    <thead>
                        <tr>
                            <th>Model</th>
                            <th>Brand</th>
                            <th class='w-25'>Read More</th>
                        </tr>
                    </thead>
                    <tbody>
                ";
                foreach ($data as $item) 
                { 
                    $table .= "
                        <tr>
                            <td sty>{$item['sku']}</td>
                            <td>{$item['brand']}</td>
                            <td><a href='/explore/{$item['sku']}/manuals' class='btn btn-info btn-sm'>
                                <i class='fa fa-search'></i>
                                Explore
                            </a>
                        </td>
                    </tr>
                ";
                }
        $table .= '</tbody></table>';
        return $table;
    }

    private function education(array $data): array {
        $html = '';
        foreach ($data['data'] as $education) {
            $url = explode("](", $education['url']);
            $title = ltrim($url[0], '[');
            try {
                if (isset($url[1])) {
                    $link = rtrim($url[1], ')');
                    $link = str_replace('"', "", $link);
                    $ytlink = explode("embed/", $url[1]);
                    $ytlinkid = explode("?si=", $ytlink[1]);
                    $yt = $ytlink[0]."watch?v=".$ytlinkid[0];
                    $thumbnail = "https://img.youtube.com/vi/".$ytlinkid[0]."/hqdefault.jpg";
                    $watch_link = $ytlink[0] ."embed/". $ytlinkid[0] . "?autoplay=1&mute=0&enablejsapi=1";
                    $html .= "
                        <div class='col-lg-3 mb-4' title='".str_replace('"', "", $title)."'>
                            <div class='education-image btn-education' 
                                data-src='".addslashes($watch_link)."'
                                data-title='".str_replace('"', "", $title)."'
                                data-share='".url("shared/".$education['id']."/education")."'
                            >
                                <img src='".$thumbnail."' class='img-fluid ' />
                                <div class='image-overlay'>
                                    <i class='fa fa-play-circle'></i>
                                </div>
                                
                            </div>
                            <div class='video-title'>
                            ".str_replace('"', "", $title)."
                            </div>
                        </div>
                    ";
                }
            } catch (\Exception $e) {
                logInfo($e->getMessage());
            }
        }
        return [
            'html' => $html,
            'pageno' => $data['current_page'],
            'next_page' => $data['current_page'] + 1,
            'page_total' => ceil($data['total'] / 15)
        ];
    }

    private function education_playlist(array $data): array {
        try {
            $html = "<div class='col-md-9'>
                        <iframe src='' 
                            id='iframePlaylist'
                            frameborder='0' 
                            allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' 
                            style='width: 100%; height: 100%;'
                            allowfullscreen>
                        </iframe>
                    </div>
                    <div class='col-md-3' style='max-height: 800px; overflow-y: auto; border: 1px solid #ccc;'>";
                try {
                    foreach ($data as $education) {
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
                            $html .= "
                                <div class='education-image btn-playlist mt-4'  style='float: right; width: 100%; height: auto;'
                                    data-src='".addslashes(str_replace('"', "", $watch_link))."'
                                >
                                    <img src='".$thumbnail."' class='img-fluid ' />
                                    <div class='image-overlay'>
                                        <i class='fa fa-play-circle'></i>
                                    </div>
                                    <div class='video-title px-2' title='".str_replace('"', "", $title)."'>
                                        ".str_replace('"', "", $title)."
                                    </div>
                                </div>
                            ";
                        }
                    }
                } catch (\Exception $e) {
                    logInfo($e->getMessage());
                } 
            $html .= "</div>";
            return ['html' => $html];
            
        } catch (\Exception $e) {
            logInfo($e->getMessage());
            return ['html' => ''];
        }
    }

    private function job_sites_list(array $data): string {
        $card = "";
        foreach ($data as $job_area) {
            $description =  strlen($job_area['description']) > self::DESCRIPTION_MAX_LENGTH ? 
                            substr($job_area['description'], 0, self::DESCRIPTION_MAX_LENGTH).'...' : 
                            $job_area['description'];
            $card .= "
                <div class='col-md-4'>
                    <div class='card'>
                        <div class='card-body'>
                            <div class='d-flex justify-content-between'>
                                <a href='".route('job-sites-areas', $job_area['id'])."'>
                                    <h5 class='card-title text-info'>".addslashes($job_area['title'])."</h5>
                                </a>
                                <div class='basic-dropdown'>
                                    <div class='dropleft mb-1'>
                                        <button type='button' class='btn btn-sm mb-1 btn-rounded btn-outline-info' data-toggle='dropdown'>
                                            <i class='fa fa-ellipsis-v'></i>
                                        </button>
                                        <div class='dropdown-menu'>
                                            <a class='dropdown-item mb-1 text-primary' href='".route('job-sites-areas', $job_area['id'])."'>
                                                <i class='fa fa-eye'></i> View Areas
                                            </a>
                                            <a 
                                            class='dropdown-item text-danger' 
                                            href='javascript:void(0);' data-trigger='delete-job-site' 
                                            data-id='".$job_area['id']."'>
                                                <i class='fa fa-trash'></i> Delete Job Site
                                            </a>
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                            <p class='card-text'>".addslashes($description)."</p>
                        </div>
                    </div>
                </div>
            ";
        }
        return $card;
    }


    public function formatManualUrls(string $urls) {
        try {
            $manual_urls = [];
            $clean_urls = str_replace(["\r", "\n"], '', $urls);
            $array_urls = explode("[", $clean_urls);
            
            $array_clean_urls = array_filter($array_urls, fn($url) => trim($url) != "");
            
            foreach ($array_clean_urls as $url) {
                $manual_url = explode("](", $url);
                if (strpos(strtolower($manual_url[1]), "tel:") !== false) {
                    $manual_urls['tels'] = str_replace(")", "", $manual_url[1]);
                } else {
                    $manual_urls['divs'][] = '<div class="mr-2 mb-2"><a href="javascript:void(0);"  data-url="'.str_replace(")", "", $manual_url[1]).'" class="btn btn-primary btn-sm" data-trigger="view-manual">'.$manual_url[0].'</a></div>';
                }
            }
            return $manual_urls;
        } catch (\Exception $e) {
            logInfo($e->getMessage());
            return ['divs' => [],'tels' => ''];
        }
        
    }
}