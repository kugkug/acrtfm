@include('partials.auth.header')

<section class="container-fluid">
    <div class="row">
        <div class="col-lg-4">
            <div class="card shadow-sm cursor-pointer" data-trigger="model_lookup" data-url="{{ route('model-lookup') }}"> 
                <div class="card-body">
                    <h3 class="card-title">Model Lookup</h3>
                    <div class="d-inline-block">
                        <h2 class=""></h2>
                        <p class=" mb-0">Find a model</p>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-magnifying-glass icon-action"></i></span>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card shadow-sm cursor-pointer" data-trigger="education" data-url="{{ route('education') }}">
                <div class="card-body">
                    <h3 class="card-title">Education</h3>
                    <div class="d-inline-block">
                        <h2 class=""></h2>
                        <p class=" mb-0">Watch educational videos</p>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-video icon-action"></i></span>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card shadow-sm cursor-pointer" data-trigger="job-sites" data-url="{{ route('job-sites') }}"> 
                <div class="card-body">
                    <h3 class="card-title">Job Sites</h3>
                    <div class="d-inline-block">
                        <h2 class=""></h2>
                        <p class=" mb-0">Job Sites</p>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-building icon-action"></i></span>
                </div>
            </div>
        </div>
        {{-- <div class="col-lg-4">
            <div class="card shadow-sm cursor-pointer" data-trigger="ask_ai" data-url="{{ route('ask-ai') }}">
                <div class="card-body">
                    <h3 class="card-title">Ask A.I.</h3>
                    <div class="d-inline-block">
                        <h2 class=""></h2>
                        <p class=" mb-0">Ask a question</p>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-robot icon-action"></i></span>
                </div>
            </div>
        </div> --}}
    </div>
    <div class="row">
        
        <div class="col-lg-4">
            <a href="{{ route('troubleshooter') }}" target="_blank">
                <div class="card shadow-sm cursor-pointer"> 
                    <div class="card-body">
                        <h3 class="card-title">Troubleshooter</h3>
                        <div class="d-inline-block">
                            <h2 class=""></h2>
                            <p class=" mb-0">AC Basic Troubleshooter</p>
                        </div>
                        <span class="float-right display-5 opacity-5"><i class="fa fa-tools icon-action"></i></span>
                    </div>
                </div>
            </a>
        </div>
    </div>
</section>
@include('partials.auth.footer')
<script src="{{ asset('assets/acrtfm/js/modules/home.js') }}"></script>
