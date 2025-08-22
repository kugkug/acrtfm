@include('partials.auth.header')

<section class="container-fluid">

    <div class="row">
        <div class="col-md-12">

            <div class="card" id="div-job-area-view">
                <div class="card-body">
                    <div class='d-flex justify-content-between'>
                        
                        <h5 class="card-title">{{ $job_site_area['title'] }}</h5>

                        <a 
                            href="javascript:void(0);" 
                            data-trigger="edit-job-site-area"
                            class="text-info"
                        >
                            <i class="fa fa-edit"></i> Edit
                        </a>

                    </div>
                    <p class="card-text">{{ $job_site_area['description'] }}</p>
                </div>
                
            </div>

            <div class="card d-none" id="div-job-area-edit">
                <div class="card-body">
                    <input type="hidden" data-key="SubId" value="{{ $job_site_area['id'] }}">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input 
                            type="text" 
                            class="form-control override-input" 
                            placeholder="Job Site Area Title" 
                            data-key="Title"
                            data-default="{{ $job_site_area['title'] }}"
                        >
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea 
                            class="form-control override-textarea" 
                            placeholder="Job Site Area Description" 
                            data-key="Description"
                            data-default="{{ $job_site_area['description'] }}"
                            rows="2"
                        ></textarea>
                    </div>
                    {{-- <div class="form-group">
                        <label for="description">Accomplishments</label>
                        <textarea 
                            class="form-control override-textarea" 
                            placeholder="Job Site Area Accomplishments" 
                            data-key="Accomplishments"
                            data-default="{{ $job_site_area['description'] }}"
                            rows="2"
                        ></textarea>
                    </div> --}}

                    {{-- <div class="row">
                        <div class="col-md-12">
                            <div class="form-group d-flex justify-content-between">
                                <input type="file" class="form-control" multiple style="display: none;" data-key="SubDetailsFiles">
                                <button class="btn btn-info btn-flat" data-trigger="add-files">
                                    <i class="fa fa-plus"></i> Add More Files
                                </button>
                                <button class="btn btn-success btn-flat" data-trigger="view-files">
                                    <i class="fa fa-image"></i> 
                                    <span class="">0</span>
                                </button>
                            </div>
                        </div>
                    </div> --}}

                    
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-end mt-2">
                        <a 
                            href="javascript:void(0);" 
                            data-trigger="cancel-edit-job-site-area"
                            data-id="{{ $job_site_area['id'] }}"
                            class="btn btn-flat btn-danger mr-2"
                        >
                            <i class="fa fa-undo"></i> Cancel
                        </a>
                        <a 
                            href="javascript:void(0);" 
                            data-trigger="update-job-site-area"
                            data-id="{{ $job_site_area['id'] }}"
                            class="btn btn-flat btn-success"
                        >
                            <i class="fa fa-save"></i> Save
                        </a>
                    </div>
                </div>
            </div>
            {{-- @php
                $images = [];
                $documents = [];
                foreach($job_site_area['files'] as $file) {
                    if(in_array($file['type'], ['pdf', 'PDF'])) {
                        $documents[] = $file;
                    } else {
                        $images[] = $file;
                    }
                }
            @endphp

            <ul class="nav nav-pills mb-3 d-flex justify-content-between">
                <li class="nav-item w-50 text-center">
                    <a href="#tab-body-images" class="nav-link active show btn btn-outline-primary mr-1" data-toggle="tab" aria-expanded="false">Images</a>
                </li>
                <li class="nav-item w-50 text-center">
                    <a href="#tab-body-documents" class="nav-link btn btn-outline-primary" data-toggle="tab" aria-expanded="false">Documents</a>
                </li>
            </ul>
            <div class="tab-content br-n pn" style="min-height: 30vh !important; align-items: center;">
                <div id="tab-body-images" class="tab-pane active show p-0 m-0">
                    @if (count($images) == 0)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-danger">
                                    No images found
                                </div>
                            </div>
                        </div>
                    @else
                    <div class="image-list">
                        @foreach($images as $image)
                        <div 
                            style="background-image: url('{{ $image['url'] }}');"
                            data-trigger="view-image"
                            data-id="{{ $image['id'] }}"
                        >
                        </div>
                        @endforeach           
                    </div>
                    @endif
                </div>

                <div id="tab-body-documents" class="tab-pane" style="height: 50vh !important; width: 100% !important;">
                    @if (count($documents) == 0)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-danger">
                                    No documents found
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="row d-block d-md-none d-lg-none d-xl-none">
                            <div class="col-md-12">
                                @foreach($documents as $document)
                                <div class="d-flex justify-content-between mb-1">
                                    <a 
                                        href="{{ $document['url'] }}" 
                                        target="_blank" 
                                        class="text-info list-group-item list-group-item-action cursor-pointer mr-2">
                                        {{ $document['name'] }}
                                    </a> 
                                
                                    <button 
                                        class="btn btn-danger btn-sm"
                                        data-trigger="delete-document"
                                        data-id="{{ $document['id'] }}"
                                        data-url="{{ $document['url'] }}"
                                        style="height: 35px !important; margin: auto 0px !important;"
                                    >
                                        <i class="fa fa-trash"></i>
                                    </button>
                                    
                                </div>
                                @endforeach
                                    
                            </div>
                        </div>

                        <div class="d-none d-md-block d-lg-block d-xl-block">
                            
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="basic-list-group">
                                        <div class="list-group" id="document-list">
                                            @foreach($documents as $document)
                                                <a 
                                                    data-trigger="view-document"
                                                    data-href="{{ $document['url'] }}" 
                                                    data-id="{{ $document['id'] }}"
                                                    data-target="#document-iframe"
                                                    class="text-info list-group-item list-group-item-action cursor-pointer"
                                                >
                                                    {{ $document['name'] }}
                                                </a>
                                                
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <iframe 
                                        id="document-iframe" 
                                        class="d-block w-100" 
                                        style='width: 100%; height: 50vh !important;' 
                                        frameborder="0"
                                        controls="0"
                                        allowFullScreen="true"
                                        src="{{ $documents[0]['url'] }}"
                                    >
                                    </iframe> 
                                    <button 
                                        class="btn btn-danger float-right mt-2"
                                        data-trigger="delete-document"
                                        data-id="{{ $documents[0]['id'] }}"
                                        data-url="{{ $documents[0]['url'] }}"
                                    >
                                        <i class="fa fa-trash"></i> Delete
                                    </button>
                                </div>
                            </div>
                        </div>  
                    @endif
                </div>
            </div> --}}
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table zero-configuration dataTable">
                                <thead>
                                    <tr>
                                        <th>Accomplishment</th>
                                        <th>Accomplishment Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($job_site_area['accomplishments'] as $accomplishment)
                                        <tr class="text-info">
                                            <td>{{ 
                                                    strlen($accomplishment['accomplishment']) > 100 ? 
                                                    substr($accomplishment['accomplishment'], 0, 100) . '...' :
                                                     $accomplishment['accomplishment'] }}</td>
                                            <td>{{ date('F d, Y', strtotime($accomplishment['accomplishment_date'])) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal for viewing images one by one with delete option -->
{{-- <div class="modal fade modal-fullscreen" id="modal-images" tabindex="-1" role="dialog" aria-labelledby="modal-images-label" aria-hidden="true">
    
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        
        <div class="modal-content">
            
            <div class="modal-body">
                <div class="d-flex justify-content-end mb-3">
                    <button class="btn btn-default btn-flat" data-trigger="close-image" data>
                        <i class="fa fa-times"></i>
                    </button>
                </div>
                <div id="carousel-images" class="carousel slide" data-ride="carousel" data-interval="false">
                    <div class="carousel-inner">
                        @php $first = true; @endphp
                        @foreach($images as $image)
                            <div class="carousel-item" id="carousel-item-{{ $image['id'] }}" data-id="{{ $image['id'] }}">
                                <div class="d-flex flex-column justify-content-center align-items-center">
                                    <img src="{{ $image['url'] }}" class="d-block" style="max-height:85vh; max-width:100%;" alt="{{ $image['name'] }}">
                                </div>
                            </div>
                            @php $first = false; @endphp
                        @endforeach
                    </div>
                    @if(count($images) > 1)
                        <a class="carousel-control-prev" href="#carousel-images" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carousel-images" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    @endif
                </div>
               
                <div class="d-flex justify-content-between">

                    <button 
                        class="mt-3 btn btn-danger btn-block btn-flat" 
                        data-trigger="delete-image"
                        data-id=""
                        data-url=""
                    >
                        <i class="fa fa-trash"></i> Delete
                    </button>
                </div>
                

            </div>
        </div>
    </div>
</div> --}}

<div class="modal fade" id="modal-files-view" tabindex="-1" role="dialog" aria-labelledby="modal-files-label" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Files</h5>
            </div>
            <div class="modal-body">
                <ul class="nav nav-pills mb-3 d-flex justify-content-between">
                    <li class="nav-item w-50 text-center">
                        <a href="#modal-tab-body-images" class="nav-link active show" data-toggle="tab" aria-expanded="false">Images</a>
                    </li>
                    <li class="nav-item w-50 text-center">
                        <a href="#modal-tab-body-documents" class="nav-link" data-toggle="tab" aria-expanded="false">Documents</a>
                    </li>
                </ul>
                <div 
                    class="tab-content br-n pn"
                    style="min-height: 30vh !important; align-items: center; display: flex; justify-content: center;"
                >
                    <div id="modal-tab-body-images" class="tab-pane active show p-0 m-0">
                        <div class="bootstrap-carousel w-100">
                            <div id="image-carousel" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner"></div>
                                <a class="carousel-control-prev" href="#image-carousel" data-slide="prev">
                                    <span class="carousel-control-prev-icon"></span> <span class="sr-only">Previous</span> 
                                </a>
                                <a class="carousel-control-next" href="#image-carousel" data-slide="next">
                                    <span class="carousel-control-next-icon"></span> <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div id="modal-tab-body-documents" class="tab-pane" style="height: 50vh !important; width: 100% !important;">
                        <div class="d-md-none d-lg-none d-xl-none">
                            <div class="basic-list-group">
                                <div class="list-group" id="document-list">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="bootstrap-carousel d-none d-md-block d-lg-block d-xl-block">
                            <div id="document-carousel" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner"></div>
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
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>




@include('partials.auth.footer')

<script src="{{ asset('assets/acrtfm/js/modules/job-site-area-view.js') }}"></script>
