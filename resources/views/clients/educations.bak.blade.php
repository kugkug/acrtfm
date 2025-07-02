@include('partials.clients.headers')
<?php

    if ($search_type == "category") {
        $catsel =  " selected";
        $catdnone =  "";
    } else {
        $catsel =  "";
        $catdnone =  "d-none";
    }

    if ($search_type == "presentor") {
        $presel =  " selected";
        $prednone =  "";
    } else {
        $presel =  "";
        $prednone =  "d-none";
    }

    if ($search_type == "keyword") {
        $wordsel =  " selected";
        $worddnone =  "";
    } else {
        $wordsel =  "";
        $worddnone =  "d-none";
    }

    sort($presentors);
?>

    <section class="container">
        <div class="row">
            <div class="col-md-12 mb-5">
                <form action="/education/search" method="GET">
                    @csrf
                    <label for="">Search By: </label>
                    <select class="form-control mt-2" name="search_type" id="search_type">
                        <option value="">Search By</option>
                        <option value="keyword"  {{ $wordsel }}>Keyword</option>
                        <option value="category"  {{ $catsel }}>Category</option>
                        <option value="presentor" {{ $presel }}>Presentor</option>
                    </select>

                    <div class="input-group mt-2 {{ $worddnone }}" id="div-keyword">
                        <input type="text" name="keyword" id="keyword" class="form-control" placeholder="Search by keyword" value="{{ $keyword }}">
                        <div class="input-group-append">
                            <button class="btn btn-primary" id="btn-search">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>

                    <select class="form-control mt-2 {{$catdnone}}" name="category_name" id="category_name">
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

                    <select class="form-control mt-2 {{$prednone}}" name="presentor_name" id="presentor_name">
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
                </form>
            </div>
        </div>   
        <div class="row">
            @foreach ($educations as $education)
            <?php
                try {
                    $url = explode("](", $education->url);
                    $title = ltrim($url[0], '[');
                    
                    if (isset($url[1])) 
                    {
                        $link = rtrim($url[1], ')');
                        $ytlink = explode("embed/", $url[1]);
                        $ytlinkid = explode("?si=", $ytlink[1]);
                        $yt = $ytlink[0]."watch?v=".$ytlinkid[0];
            ?>
                    <div class="col-sm-3 div-video">
                        <div class="card">
                            <div class="card-header">
                                <medium class="d-inline-block text-truncate" style="max-width: 100%;">{{$title}}</medium>
                            </div>
                            <div class="card-body p-1">
                                <iframe class="w-100 iframe" 
                                    src="{{ $link }}" 
                                    frameborder="0" allow="accelerometer; autoplay; 
                                    clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                                </iframe>
                            </div>
                            <div class="card-footer p-1">
                                <button class="btn btn-block btn-sm btn-outline-primary btn-iframe" 
                                    data-value='<iframe class="w-100" src="{{ $link }}&autoplay=1" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>'
                                    data-title='{{$title}}'
                                >
                                    <i class="fas fa-play"></i> Play
                                </button>
                                                                    
                            </div> 
                        </div>
                    </div>
            <?php
                }            
            } catch(Exception) {}
            ?>
            @endforeach
    </div>

</section>
<section class="mt-5 d-flex justify-content-center">
    {{ $educations->links() }}
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
                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>
@include('partials.clients.footers')

{{-- <script src="{{ asset('adminlte3.2/plugins/jquery/jquery.min.js') }}"></script> --}}
<script src="{{ asset('scripts/educations.js') }}"></script>