@include('partials.single-page.header')

@php
    $url = $ac_details['url'];
    $urls = responseHelper()->formatManualUrls($url);

    $manuals = $ac_details['manuals'] ?? [];
@endphp

<section class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">
                        <i class="fa fa-book"></i>
                        
                        List of Available Manuals
                        @if(isset($urls['tels']) && $urls['tels'] != '')
                            - {!! strtoupper($urls['tels']) !!}
                        @endif
                    </h3>
                    
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="d-flex flex-wrap">
                            
                                @if(count($urls['divs']) > 0)
                                    @php
                                        $divs = join('', $urls['divs']);
                                    @endphp
                                    {!! $divs !!}
                                @endif
                                
                                @foreach ($manuals as $manual)

                                    <div class="mr-2 mb-2">
                                        <a href="javascript:void(0);" 
                                            data-url="{{ config('acrtfm.manual_url') . "manuals/".$manual['filename'] }}" 
                                            class="btn btn-primary btn-sm"
                                            data-trigger="view-manual"
                                        >
                                            {{ $manual['label'] }}
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    {!! $action_button !!}
    <div class="row mt-2">
        <div class="col-md-12">
            <iframe id="ifrPdf" src="" style="width:100%;" height="600px" frameborder="0"></iframe>
        </div>
    </div>

</section>


@include('partials.single-page.footer')

<script src="{{ asset('assets/acrtfm/js/modules/model-lookup.js') }}"></script>
