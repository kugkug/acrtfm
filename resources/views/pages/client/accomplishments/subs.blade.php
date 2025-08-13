@include('partials.auth.header')

<section class="container-fluid">


    <div class="row">
        @foreach($accomplishment['details'] as $detail) 
            <div class="col-md-3">
                <div class="card">
                    @if ($detail['files'][0]['filetype'] == 'pdf')
                        <iframe 
                            src="{{ $detail['files'][0]['url'] }}" 
                            class="d-block w-100" 
                            style='width: 100%; height: 300px; object-fit: cover;'
                            frameborder="0">
                        </iframe> 
                    @else
                        <img 
                            class="img-fluid" 
                            src=" {{ $detail['files'][0]['url'] }}" 
                            alt="" 
                            style="width: 100%; height: 300px; object-fit: cover;">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $detail['title'] }}</h5>
                        <p class="card-text">{{ strlen($detail['description']) > 30 ? substr($detail['description'], 0, 30) . '...' : $detail['description'] }}</p>
                    </div>

                    <div class="card-footer">
                        <a href="{{ route('job-sites-view', $detail['id']) }}" class="btn btn-primary btn-sm">View More</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>


@include('partials.auth.footer')

