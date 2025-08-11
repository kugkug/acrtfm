@include('partials.auth.header')

<section class="container-fluid">

    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Accomplishment</h5>
                    <p class="card-text">{{ $accomplishment['accomplishment'] }}</p>                  
                    
                </div>
                <div class="card-footer d-flex justify-content-between">

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

            @php
                $images = [];
                $documents = [];
                foreach($accomplishment['files'] as $file) {
                    if(in_array($file['filetype'], ['pdf', 'PDF'])) {
                        $documents[] = $file;
                    } else {
                        $images[] = $file;
                    }
                }
            @endphp

            <ul class="nav nav-pills mb-3 d-flex justify-content-between">
                <li class="nav-item w-50 text-center">
                    <a href="#tab-body-images" class="nav-link active show" data-toggle="tab" aria-expanded="false">Images</a>
                </li>
                <li class="nav-item w-50 text-center">
                    <a href="#tab-body-documents" class="nav-link" data-toggle="tab" aria-expanded="false">Documents</a>
                </li>
            </ul>
            <div 
                class="tab-content br-n pn"
                style="min-height: 30vh !important; align-items: center; display: flex; justify-content: center;"
            >
                <div id="tab-body-images" class="tab-pane active show p-0 m-0">
                    <div class="bootstrap-carousel w-100">
                        <div id="image-carousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                @foreach($images as $image)
                                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                        <img class="d-block w-100" src="{{ $image['filename'] }}" alt="{{ $image['filename'] }}">
                                    </div>
                                @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#image-carousel" data-slide="prev">
                                <span class="carousel-control-prev-icon"></span> <span class="sr-only">Previous</span> 
                            </a>
                            <a class="carousel-control-next" href="#image-carousel" data-slide="next">
                                <span class="carousel-control-next-icon"></span> <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div id="tab-body-documents" class="tab-pane" style="height: 50vh !important; width: 100% !important;">
                    <div class="bootstrap-carousel">
                        <div id="document-carousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">

                                
                                @foreach($documents as $document)
                                
                                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                        <iframe 
                                            src="{{  $document['filename'] }}" 
                                            class="d-block w-100" 
                                            style='width: 100%; height: 50vh !important;' 
                                            frameborder="0">
                                        </iframe> 
                                    </div>
                                @endforeach
                                
                                
                            </div>
                            <a class="carousel-control-prev" href="#document-carousel" data-slide="prev">
                                <span class="carousel-control-prev-icon"></span> <span class="sr-only">Previous</span> 
                            </a>
                            <a class="carousel-control-next" href="#document-carousel" data-slide="next">
                                <span class="carousel-control-next-icon"></span> <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            
        </div>
    </div>
</section>


@include('partials.auth.footer')

<script src="{{ asset('assets/acrtfm/js/modules/accomplishments.js') }}"></script>
