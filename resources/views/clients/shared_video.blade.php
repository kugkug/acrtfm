@include('partials.clients.headers')
<input type="hidden" id="pageno">
<input type="hidden" id="page_total">
<section class="container">
    <div class="row">
        <div class="col-md-12 mb-5 div-playlist-body">
            {!! $video !!}
        </div>
    </div>



</section>

@include('partials.clients.footers')

<script src="{{ asset('scripts/modules/scripts.js') }}"></script>
<script src="https://www.youtube.com/iframe_api"></script>
