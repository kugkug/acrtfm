@include('partials.clients.headers')
    <input type="hidden" id="pageno">
    <input type="hidden" id="page_total">
    <section class="container">
        <div class="row">
            <div class="col-md-12">
                {{-- <form action="/education/search" method="GET"> --}}
                    {{-- @csrf --}}
                    <label for="">Search By: </label>
                    <select class="form-control mt-2" name="search_type" id="search_type">
                        <option value="">Search By</option>
                        <option value="keyword">Keyword</option>
                        <option value="category">Category</option>
                        <option value="presentor">Presentor</option>
                        <option value="playlist">Playlist</option>
                    </select>

                    <div class="input-group mt-2 d-none" id="div-keyword">
                        <input type="text" name="keyword" id="keyword" class="form-control" placeholder="Search by keyword" value="{{ $keyword }}">
                        <div class="input-group-append">
                            <button class="btn btn-primary" id="btn-search">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>

                    <select class="form-control mt-2 d-none" name="category_name" id="category_name">
                        <option value="">Select Category Name</option>
                        
                        @foreach ($categories as $category)
                            {{$category}}
                            <option 
                                value="{{$category}}"  
                                <?=(strtoupper($category) == strtoupper($category_name) ? " selected" : "");?>
                            >
                            {{strtoupper($category)}}
                            </option>
                        @endforeach
                    </select>

                    <select class="form-control mt-2 d-none" name="presentor_name" id="presentor_name">
                        <option value="">Select Presentor Name</option>
                        @foreach ($presentors as $presentor)
                            <option 
                                value="{{$presentor}}"  
                                <?=(strtoupper($presentor) == strtoupper($presentor_name) ? " selected" : "");?>
                            >
                            {{strtoupper($presentor)}}
                            </option>
                        @endforeach
                    </select>

                    <select class="form-control mt-2 d-none" name="playlist_name" id="playlist_name">
                        <option value="">Select Playlist</option>
                        
                        @foreach ($playlists as $playlist)
                            <option 
                                value="{{$playlist}}"  
                            >
                            {{strtoupper($playlist)}}
                            </option>
                        @endforeach
                    </select>
                {{-- </form> --}}
            </div>
        </div>   

        <div class="row">
            <div class="col-md-12 mb-5">
                {{-- <iframe id="vid" class="w-100 iframe" src="https://www.youtube.com//embed/WrI8XLEvPbI?autoplay=1&amp;mute=0&enablejsapi" 
                frameborder="0" allow="autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen=""> </iframe> --}}

                {{-- <iframe id="existing-iframe-example"
                        width="640" height="360"
                        src="https://www.youtube.com/embed/M7lc1UVf-VE?autoplay=1&mute=0&enablejsapi=1"
                        frameborder="0"
                        style="border: solid 4px #37474F"
                ></iframe> --}}
            </div>
        </div>   
        <div class="row">
            <div class="col-md-12">
                <div class="div-table-data" id="div-table-data"></div>
            </div>
        </div>
    </div>

    

</section>
<div class="modal fade" id="modelModal" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalTitle"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" id="modal-body">
                <iframe class='w-100 iframe' src='' frameborder='0' allow='accelerometer; autoplay; 
                    clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share'
                    referrerpolicy='strict-origin-when-cross-origin' allowfullscreen>
                </iframe>
            </div>

            <div class="modal-footer">
                <button class="btn btn-outline-success" data-share="">
                    <i class="fa fa-share"></i> Copy Share Link
                </button>
            </div>
        </div>
    </div>
</div>
@include('partials.clients.footers')

{{-- <script src="{{ asset('adminlte3.2/plugins/jquery/jquery.min.js') }}"></script> --}}
<script src="{{ asset('scripts/modules/scripts.js') }}"></script>
{{-- <script src="{{ asset('scripts/lib/waypoints-master/src/waypoint.js') }}"></script> --}}
<script src="https://www.youtube.com/iframe_api"></script>
<script src="{{ asset('scripts/educations.js') }}"></script>