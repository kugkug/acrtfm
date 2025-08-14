@include('partials.auth.header')

<section class="container-fluid">


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    
                    <h5 class="card-title">{{ $job_site_area['title'] }}</h5>
                    <p class="card-text">{{ $job_site_area['description'] }}</p>
                    
                    @php
                        print_r($job_site_area);
                    @endphp
                    {{-- <div class="row">
                        @foreach($accomplishment['details'] as $detail)
                            <div class="col-md-4">
                                <h6>{{ $detail['title'] }}</h6>
                                <p>{{ $detail['description'] }}</p>
                            </div>
                        @endforeach
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</section>


@include('partials.auth.footer')

