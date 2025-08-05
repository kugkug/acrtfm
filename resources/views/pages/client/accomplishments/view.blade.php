@include('partials.auth.header')

<section class="container-fluid">

    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Accomplishment</h5>
                    <p class="card-text">{{ $accomplishment['title'] }}</p>                  
                    
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <a
                        href="{{ route('my-accomplishments-add', $accomplishment['id']) }}" 
                        class="btn btn-primary mr-2">
                        <i class="fa fa-plus"></i> New
                    </a>

                    <button 
                        class="btn btn-info mr-2" 
                        data-trigger="edit-accomplishment" 
                        data-id="{{ $accomplishment['id'] }}">
                        <i class="fa fa-edit"></i> Edit
                    </button>

                    <button 
                        class="btn btn-danger" 
                        data-trigger="delete-accomplishment" 
                        data-id="{{ $accomplishment['id'] }}" 
                        data-parent="{{ $accomplishment['parent']['id'] }}"
                    >
                        <i class="fa fa-trash"></i> Delete
                    </button>
                </div>
            </div>

            <div class="bootstrap-carousel">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner" style="min-height: 30vh !important; align-items: center; display: flex; justify-content: center;">
                        @foreach($accomplishment['photos'] as $photo)
                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                <img class="d-block w-100" src="{{ '/storage/accomplishment_images/'.$photo['filename'] }}" alt="First slide">
                            </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" data-slide="prev">
                        <span class="carousel-control-prev-icon"></span> <span class="sr-only">Previous</span> 
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" data-slide="next">
                        <span class="carousel-control-next-icon"></span> <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>


@include('partials.auth.footer')

<script src="{{ asset('assets/acrtfm/js/modules/accomplishments.js') }}"></script>
