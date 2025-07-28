@include('partials.auth.header')

<section class="container-fluid ">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">
                        
                        <i class="fa fa-magnifying-glass"></i>
                        Search By
                    </h3>
                    <div class="row">
                        <div class="col-lg-12">
                            <select class="form-control mt-2" data-key="search_type">
                                <option value="">Search By</option>
                                <option value="keyword">Keyword</option>
                                <option value="category">Category</option>
                                <option value="presentor">Presentor</option>
                                <option value="playlist">Playlist</option>
                            </select>

                            <div class="input-group mt-2 d-none search-container-keyword">
                                <input type="text" class="form-control search-text" placeholder="Search by keyword">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" id="btn-search">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
        
                            <select class="form-control mt-2 d-none search-container-category search-select">
                                <option value="">Select Category Name</option>
                                
                                @foreach ($categories as $category)
                                    @if($category != "")
                                        <option value="{{$category}}">
                                        {{strtoupper($category)}}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
        
                            <select class="form-control mt-2 d-none search-container-presentor search-select">
                                <option value="">Select Presentor Name</option>
                                @foreach ($presentors as $presentor)
                                    <option 
                                        value="{{$presentor}}"  
                                    >
                                    {{strtoupper($presentor)}}
                                    </option>
                                @endforeach
                            </select>
        
                            <select class="form-control mt-2 d-none search-container-playlist search-select">
                                <option value="">Select Playlist</option>
                                
                                @foreach ($playlists as $playlist)
                                    <option value="{{$playlist}}">{{strtoupper($playlist)}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @include('components.loader.sub-loader')
                </div>
            </div>
        </div>
    </div>

    <div class="row div-result"></div>
    
    
</section>

<div class="modal fade" id="educationModal">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="overflow: hidden !important; ">
            
            <div class="modal-body p-0">
                <iframe 
                    style="height: 600px; width: 100% !important;"
                    id="educationPlayer" 
                    src="" 
                    frameborder="0" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                    referrerpolicy="strict-origin-when-cross-origin" 
                    allowfullscreen
                >
                </iframe>
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <button type="button" class="btn btn-success">
                    <i class="fa fa-share"></i> Share Video
                </button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    <i class="fa fa-times"></i> Close
                </button>
            </div>
        </div>
    </div>
</div>

<input type="hidden" id="pageno">
<input type="hidden" id="page_total">
<input type="hidden" id="next_page">

@include('partials.auth.footer')


<script src="{{ asset('assets/acrtfm/js/modules/education.js') }}"></script>

