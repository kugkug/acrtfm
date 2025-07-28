<?php

declare(strict_types=1);
namespace App\Helpers;

class ResponseHelper {
    public function toastrResponse(string $message, string $type = 'error', string $title = 'System Error'): array {
        return [
            'js' => "_show_toastr('".$type."', '".$message."', '".$title."');"
        ];
    }

    public function scriptResponse(string $exec, array $data, string $message='', string $toast_type = 'success', string $title = 'System Info'): array {
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
                    <div class='col-lg-4 col-md-6 col-sm-12 mb-4'>
                            <div class='education-image btn-education' 
                                data-src='".addslashes($watch_link)."'
                                data-title='".$title."'
                            >
                                <img src='".$thumbnail."' class='img-fluid ' />
                                <div class='image-overlay'>
                                    <i class='fa fa-play-circle'></i>
                                </div>
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
                                    ".str_replace('"', "", $title)."
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
        // $html = '';
        // foreach ($data['data'] as $education) {
        //     $html .= $education['url'];
        // }
        // return ['html' => $html];
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