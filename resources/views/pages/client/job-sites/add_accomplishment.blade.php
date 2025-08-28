@include('partials.auth.header')

<section class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">{{ $job_area['title'] }}</h3>
                    <p class="card-text">{{ $job_area['description'] }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <input type="hidden" data-key="JobAreaId" value="{{ $job_area['id'] }}">
            <div class="form-group">
                <label for="accomplishment">Accomplishment</label>
                <textarea rows="5" class="form-control override-textarea" data-key="Accomplishment"></textarea>
            </div>
            <div class="form-group">
                <label for="accomplishment_date">Accomplishment Date</label>
                <input type="date" class="form-control override-input" data-key="AccomplishmentDate">
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group d-flex justify-content-between">
                        <input type="file" class="form-control" multiple style="display: none;" data-key="AccomplishmentFiles">
                        <button class="btn btn-info btn-flat" data-trigger="add-files">
                            <i class="fa fa-plus"></i> Add Documents / Images
                        </button>
                        <button class="btn btn-success btn-flat" data-trigger="view-files">
                            <i class="fa fa-image"></i> 
                            <span class="">0</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">

                <button class="btn btn-success btn-flat" data-trigger="add-accomplishment">
                    <i class="fa fa-save"></i> Save Accomplishment
                </button>
            </div>
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
                                <div class="list-group" id="document-list-view">
                                    
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

<script src="{{ asset('assets/acrtfm/js/modules/add_accomplishment.js') }}"></script>
