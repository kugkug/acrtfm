@include('partials.auth.header')

<section class="container-fluid">


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">New Job Site</h5>
                    <div class="form-group mb-3">
                        <label for="job_site_name">Job Site Name</label>
                        <input type="text" class="form-control" id="job_site_name" name="job_site_name" placeholder="Enter job site name" required>
                    </div>
                    <div class="form-group mb-4">
                        <label for="job_site_description">Job Site Description</label>
                        <textarea class="form-control" id="job_site_description" name="job_site_description" rows="2" placeholder="Enter job site description" required></textarea>
                    </div>
                </div>
            </div>

            <div class="card card-area area-main-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <h5 class="card-title">Area <span>1</span></h5>
                    </div>
                
                    <div class="form-group mb-2">
                        <input type="text" class="form-control" placeholder="Enter task name" required>
                    </div>
                    <div class="form-group mb-2">
                        <textarea class="form-control" rows="2" placeholder="Enter task description" required></textarea>
                    </div>
                    <div class="form-group mb-2">
                        
                        <textarea class="form-control" rows="2" placeholder="Enter task accomplishments"></textarea>
                    </div>
                    <div class="form-group mb-2">
                        <input type="file" class="form-control" multiple accept="image/*">
                    </div>
                </div>
            </div>            
        

            <div class="row mb-2">
                <div class="col-md-6 my-1">
                    <button class="btn btn-info btn-flat btn-block" data-trigger="add-area">
                        <i class="fa fa-plus"></i> Add Area
                    </button>
                </div>
                <div class="col-md-6 my-1">
                    <button class="btn btn-success btn-flat btn-block" data-trigger="save-job-site">
                        <i class="fa fa-save"></i> Save Job Site
                    </button>
                </div>
                
            </div>
        </div>

    </div>

</section>


@include('partials.auth.footer')
<script src="{{ asset('assets/acrtfm/js/modules/jobs.js') }}"></script>