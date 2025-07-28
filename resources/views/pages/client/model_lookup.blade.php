@include('partials.auth.header')

<section class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">
                        <i class="fa fa-magnifying-glass"></i>
                        Enter a model number
                    </h3>
                    <div class="row">
                        <div class="col-lg-12">
                            <input type="text" class="form-control" placeholder="Model number" data-key="ModelNumber" data-url="{{ route('exec-model-lookup-search') }}">

                            @include('components.loader.sub-loader')
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 div-result table-responsive">
            
        </div>
    </div>
</section>


@include('partials.auth.footer')

<script src="{{ asset('assets/acrtfm/js/modules/model-lookup.js') }}"></script>
