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

            @if(isset($job_site_area['accomplishments']) && count($job_site_area['accomplishments']) > 0)
                @foreach($job_site_area['accomplishments'] as $accomplishment)

                    <div class="card">
                        <div class="card-body">
                            <a 
                                href="{{ route('job-site-area-accomplishment', ['accomplishment_id' => $accomplishment['id']]) }}"
                                class="text-info"
                            >
                                <h3 class="card-title text-info">{{ $accomplishment['accomplishment_date'] }}</h3>
                                <p class="card-text">{{ $accomplishment['accomplishment'] }}</p>
                            </a>
                        </div>
                    </div>

                @endforeach
            @else   
                <div class="alert alert-danger">
                    <h3 class="text-danger">No Accomplishments</h3>
                </div>
            @endif
        </div>
    </div>

</section>

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
