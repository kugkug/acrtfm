@include('partials.auth.header')

<!-- Link the education CSS file -->
<link href="{{ asset('assets/acrtfm/css/education.css') }}" rel="stylesheet">

<section class="container-fluid px-5">
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

                            @include('components.loader.sub-loader')
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    <div class="row div-result"></div>
</section>

<!-- Video Popup Overlay -->
<div class="video-popup-overlay" id="videoPopupOverlay">
    <div class="video-popup-container">
        <button class="video-close-btn" id="videoCloseBtn">
            <i class="fa fa-times"></i>
        </button>
        
        <div class="video-player" id="videoPlayer">
            <div class="video-loading">
                <i class="fa fa-spinner"></i>
                <span>Loading video...</span>
            </div>
        </div>
        
        <div class="video-controls">
            <div class="video-title" id="videoTitle"></div>
            <div class="video-description" id="videoDescription"></div>
            <button class="share-button" id="shareButton">
                <i class="fa fa-share"></i>
                Share Video
            </button>
        </div>
    </div>
</div>

@include('partials.auth.footer')


<script src="{{ asset('assets/acrtfm/js/modules/education.js') }}"></script>

