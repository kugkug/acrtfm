@include('partials.auth.header')

<section class="container-fluid">


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    
                    <h5 class="card-title">{{ $accomplishment['title'] }}</h5>
                    <p class="card-text">{{ $accomplishment['description'] }}</p>
                    
                    @php
                        print_r($accomplishment);
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

