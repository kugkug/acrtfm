@include('partials.clients.headers')
<section class="container">
    <div class="card">
        <div class="card-header">
                <div id="div-models">
                    <label for="">Ask anything:</label>
                    <div class="input-group input-group-md">
                        <input
                            autocomplete="off" 
                            type="text" 
                            id="table_search" 
                            name="table_search" 
                            class="form-control" 
                            placeholder="Type in your inquiry"
                        >
                        <span class="input-group-append">
                            <button type="button" id="btn-inquire" class="btn btn-primary">Ask An Expert</button>
                        </span>
                    </div>
                </div>
            
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div id="div-links"></div>
                </div>

                <div class="col-md-8">
                    
                    <iframe 
                        id="ifrPdf"
                        src=""
                        style="width:100%;" 
                        height="600"
                        frameborder="0"
                    ></iframe>

                    {{-- http://docs.google.com/gview?url=https://acrtfm.com/manuals/2_cb024-036-048-060_Insopmain.pdf&embedded=true --}}
                </div>
            </div>
            {{-- <div class="table-responsive p-0" id="div-model-data"></div> --}}
        </div>
    </div>
    
</section>
@include('partials.clients.footers')

<script type="module" src="{{ asset('scripts/ask-an-expert.js')}}"></script>
<script type="module" src="{{ asset('scripts/modules/genai.js')}}"></script>

{{-- <script src="{{ asset('scripts/ask-an-expert.js') }}"></script> --}}
{{-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"> --}}


