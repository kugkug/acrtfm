@include('partials.auth.header')

<link href="{{ asset('vendor/lightgallery/css/lightgallery.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendor/lightgallery/plugins/video/lg-video.min.css') }}" rel="stylesheet">

<div id="gallery-videos-demo">
    <!-- YouTube Video --->
    <a
        data-lg-size="1280-720"
        data-src="//www.youtube.com/watch?v=EIUJfXk3_3w"
        data-poster="https://img.youtube.com/vi/EIUJfXk3_3w/maxresdefault.jpg"
        data-sub-html="<h4>Puffin Hunts Fish To Feed Puffling | Blue Planet II | BBC Earth</h4><p>On the heels of Planet Earth II's record-breaking Emmy nominations, BBC America presents stunning visual soundscapes from the series' amazing habitats.</p>"
    >
        <img
            width="300"
            height="100"
            class="img-responsive"
            src="https://img.youtube.com/vi/EIUJfXk3_3w/maxresdefault.jpg"
        />
    </a>

   
</div>
@include('partials.auth.footer')
