@include('partials.auth.header')

<section class="container-fluid">


    <div class="row">
        @foreach($accomplishment['details'] as $detail) 
            <div class="col-md-3">
                <div class="card">
                    <img 
                        class="img-fluid" 
                        src=" {{ $detail['files'][0]['filename'] }}" 
                        alt="" 
                        style="width: 100%; height: 300px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $detail['title'] }}</h5>
                        <p class="card-text">{{ strlen($detail['description']) > 30 ? substr($detail['description'], 0, 30) . '...' : $detail['description'] }}</p>
                    </div>

                    <div class="card-footer">
                        <a href="{{ route('my-accomplishments-view', $detail['id']) }}" class="btn btn-primary btn-sm">View More</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>


@include('partials.auth.footer')

