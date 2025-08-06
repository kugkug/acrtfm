@include('partials.auth.header')

<section class="container-fluid">


    <div class="row">
        <div class="col-md-12 main-container">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">&nbsp;</h5>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Enter your desired name of the job site." data-key="Title">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" rows="2" placeholder="Enter a brief description of the job site." data-key="Description"></textarea>
                    </div>
                </div>
            </div>

            <div class="card card-sub-details area-main-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <h5 class="card-title"></h5>
                    </div>
                
                    <div class="form-group mb-2">
                        <input type="text" class="form-control" placeholder="Enter area/unit name." required data-key="SubDetailsName">
                    </div>
                    <div class="form-group mb-2">
                        <textarea class="form-control" rows="2" placeholder="Enter a brief description of the area/unit." required data-key="SubDetailsDescription"></textarea>
                    </div>
                    <div class="form-group mb-2">
                        
                        <textarea class="form-control" rows="3" placeholder="Enter a the tasks/services of the area/unit." data-key="SubDetailsAccomplishments"></textarea>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group mb-2 d-flex justify-content-between">
                                <input type="file" class="form-control" multiple accept="image/*" style="display: none;" data-key="SubDetailsImages">
                                <button class="btn btn-info btn-flat" data-trigger="add-images">
                                    <i class="fa fa-plus"></i> Add Images
                                </button>
                                <button class="btn btn-success btn-flat" data-trigger="view-images">
                                    <i class="fa fa-image"></i> 
                                    <span class="">0</span>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-2"></div>
                        <div class="col-md-5">
                            <div class="form-group mb-2 d-flex justify-content-between">
                                <input type="file" class="form-control" multiple style="display: none;" data-key="SubDetailsDocuments">
                                <button class="btn btn-info btn-flat" data-trigger="add-documents">
                                    <i class="fa fa-plus"></i> Add Documents
                                </button>
                                <button class="btn btn-success btn-flat" data-trigger="view-documents">
                                    <i class="fa fa-file"></i> 
                                    <span class="">0</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>            
        
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-md-6 my-1">
            <button class="btn btn-info btn-flat btn-block" data-trigger="add-accomplishment">
                <i class="fa fa-plus"></i> Add <span></span>
            </button>
        </div>
        <div class="col-md-6 my-1">
            <button class="btn btn-success btn-flat btn-block" data-trigger="save">
                <i class="fa fa-save"></i> Save
            </button>
        </div>
        
    </div>

</section>

<div class="modal fade" id="modal-images" tabindex="-1" role="dialog" aria-labelledby="modal-images-label" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            
            <div class="modal-body p-0">
                <div class="bootstrap-carousel">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner" style="min-height: 30vh !important; align-items: center; display: flex; justify-content: center;"></div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" data-slide="prev">
                            <span class="carousel-control-prev-icon"></span> <span class="sr-only">Previous</span> 
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" data-slide="next">
                            <span class="carousel-control-next-icon"></span> <span class="sr-only">Next</span>
                        </a>
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
<script src="{{ asset('assets/acrtfm/js/modules/accomplishments.js') }}"></script>