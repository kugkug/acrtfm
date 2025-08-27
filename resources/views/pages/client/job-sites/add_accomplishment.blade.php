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
            <div class="d-flex justify-content-between">
                <button class="btn btn-danger btn-flat" data-trigger="cancel-edit-accomplishment">
                    <i class="fa fa-times"></i> Cancel
                </button>
                <button class="btn btn-success btn-flat" data-trigger="update-accomplishment">
                    <i class="fa fa-save"></i> Save
                </button>
            </div>
        </div>
    </div>
</section>
@include('partials.auth.footer')