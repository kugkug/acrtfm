@include('partials.auth.header')

<section class="container-fluid">


    <div class="row">
        @foreach($job_site_areas['areas'] as $job_site_area) 
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header bg-white" style="border-radius: 0.625rem;">
                        <div class='d-flex justify-content-between'>
                            <h5 class="card-title d-flex align-items-center">
                                {{ 
                                    strlen($job_site_area['title']) > 25 ? 
                                    substr($job_site_area['title'], 0, 25) . '...' :
                                    $job_site_area['title'] 
                                }}
                            </h5>
                            <div class='basic-dropdown'>
                                <div class='dropleft mb-1'>
                                    <button type='button' class='btn mb-1 btn-rounded btn-outline-info' data-toggle='dropdown'>
                                        <i class='fa fa-ellipsis-v'></i>
                                    </button>
                                    <div class='dropdown-menu'>
                                        <a class='dropdown-item mb-1 text-primary' href='{{ route('job-site-area-view', $job_site_area['id']) }}'>
                                            <i class='fa fa-eye'></i> View Area
                                        </a>
                                        <a class='dropdown-item mb-1 text-info' href='{{ route('job-site-area-edit', $job_site_area['id']) }}'> 
                                            <i class='fa fa-edit'></i> Edit Area
                                        </a> 
                                        <a class='dropdown-item text-danger' href='javascript:void(0);' data-trigger='delete-job-area' data-id='{{ $job_site_area['id'] }}'>
                                            <i class='fa fa-trash'></i> Delete Area
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($job_site_area['files'][0]['type'] == 'pdf')
                        <iframe 
                            src="{{ $job_site_area['files'][0]['url'] }}" 
                            class="d-block w-100" 
                            style='width: 100%; height: 300px; object-fit: cover;'
                            frameborder="0">
                        </iframe> 
                    @else
                        <img 
                            class="img-fluid" 
                            src=" {{ $job_site_area['files'][0]['url'] }}" 
                            alt="" 
                            style="width: 100%; height: 300px; object-fit: cover;">
                    @endif
                    <div class="card-body">
                        <p class="card-text">
                            {{ 
                                strlen($job_site_area['accomplishments']) > 30 ? 
                                substr($job_site_area['accomplishments'], 0, 30) . '...' :
                                $job_site_area['accomplishments'] 
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

