@include('partials.single-page.header')

<section class="container-fluid">
    <div class="row mb-3">
        <div class="col-md-12">
            <a href="{{ route('education') }}" class="btn btn-success btn-md btn-flat btn-block">
                <i class="fa fa-video"></i> View More Educational Videos
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            @php
                $url = explode("](", $education['url']);
                $title = ltrim($url[0], '[');
                        
                $link = rtrim($url[1], ')');
                $link = str_replace('"', "", $link);
                $ytlink = explode("embed/", $url[1]);
                $ytlinkid = explode("?si=", $ytlink[1]);
                $yt = $ytlink[0]."watch?v=".$ytlinkid[0];
                $thumbnail = "https://img.youtube.com/vi/".$ytlinkid[0]."/hqdefault.jpg";
                $watch_link = $ytlink[0] ."embed/". $ytlinkid[0] . "?autoplay=1&mute=0&enablejsapi=1";
                        
            @endphp
            <iframe src='{{ $watch_link }}' 
                style="height: 600px; width: 100%;"
                frameborder='0' 
                allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' 
                allowfullscreen>
            </iframe>
            {!! $title !!}
        </div>
    </div>
    
</section>


@include('partials.single-page.footer')

<script src="{{ asset('assets/acrtfm/js/modules/model-lookup.js') }}"></script>
