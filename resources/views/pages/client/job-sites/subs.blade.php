@include('partials.auth.header')

<section class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            
            <div class="card" id="div-job-site-area-view">
                <div class="card-body">
                    <div class='d-flex justify-content-between'>
                        <h5 class="card-title">{{ $job_site_areas['title'] }}</h5>

                        <a 
                            href="javascript:void(0);" 
                            data-trigger="edit-job-site-area"
                            class="text-info"
                        >
                            <i class="fa fa-edit"></i> Edit
                        </a>

                    </div>
                    <p class="card-text">{{ $job_site_areas['description'] }}</p>
                </div>
                
            </div>

            <div class="card d-none" id="div-job-site-area-edit">
                <div class="card-body">
                    <div class="form-group">
                        <input 
                            type="text" 
                            class="form-control override-input" 
                            placeholder="Job Site Area Title" 
                            data-key="Title"
                            data-default="{{ $job_site_areas['title'] }}"
                        >
                    </div>
                    <div class="form-group">
                        <textarea 
                            class="form-control override-textarea" 
                            placeholder="Job Site Area Description" 
                            data-key="Description"
                            data-default="{{ $job_site_areas['description'] }}"
                            rows="2"
                        ></textarea>
                    </div>

                    <div class="d-flex justify-content-end mt-2">
                        <a 
                            href="javascript:void(0);" 
                            data-trigger="cancel-edit-job-site-area"
                            data-id="{{ $job_site_areas['id'] }}"
                            class="btn btn-danger btn-xs mr-2"
                        >
                            <i class="fa fa-undo"></i> Cancel
                        </a>
                        <a 
                            href="javascript:void(0);" 
                            data-trigger="save-job-site-area"
                            data-id="{{ $job_site_areas['id'] }}"
                            class="btn btn-success btn-xs"
                        >
                            <i class="fa fa-save"></i> Save
                        </a>
                    </div>
                </div>
            </div>

            
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-12">
            <input type="search" class="form-control override-input" placeholder="Search Job Sites" data-key="JobArea">
        </div>
    </div>
    <div class="row">
        @foreach($job_site_areas['areas'] as $job_site_area) 
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        
                        <div class='d-flex justify-content-between'>
                            <a href='{{ route('job-site-area-view', $job_site_area['id']) }}'>
                                <h5 class="card-title d-flex align-items-center text-info">
                                    {{ 
                                        strlen($job_site_area['title']) > 25 ? 
                                        substr($job_site_area['title'], 0, 25) . '...' :
                                        $job_site_area['title'] 
                                    }}
                                </h5>
                            </a>
                            <div class='basic-dropdown'>
                                <div class='dropleft mb-1'>
                                    <button type='button' class='btn btn-sm mb-1 btn-rounded btn-outline-info' data-toggle='dropdown'>
                                        <i class='fa fa-ellipsis-v'></i>
                                    </button>
                                    <div class='dropdown-menu'>
                                        <a class='dropdown-item mb-1 text-primary' href='{{ route('job-site-area-view', $job_site_area['id']) }}'>
                                            <i class='fa fa-eye'></i> View Area
                                        </a>
                                        
                                        <a 
                                            class='dropdown-item text-danger' 
                                            href='javascript:void(0);' 
                                            data-trigger='delete-job-site-area' 
                                            data-id='{{ $job_site_area['id'] }}'
                                            data-title='{{ $job_site_area['title'] }}'
                                            data-site-id='{{ $job_site_areas['id'] }}'
                                        >
                                            <i class='fa fa-trash'></i> Delete Area
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <p class="card-text">
                            {{ 
                                strlen($job_site_area['description']) > 30 ? 
                                substr($job_site_area['description'], 0, 30) . '...' :
                                $job_site_area['description'] 
                            }}
                        </p>
                    </div>

                    
                </div>
            </div>
        @endforeach
    </div>
</section>


@include('partials.auth.footer')

<script src="{{ asset('assets/acrtfm/js/modules/sub-job-site.js') }}"></script>