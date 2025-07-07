@include('partials.clients.headers')
<section class="container">
    <div class="card mb-2">
        <div class="card-header">
            <h5 class="card-title">Ask A.I.</h5>
        </div>
        <div class="card-body card-body-ai" id="div-result">
            <div class="direct-chat-messages p-0 h-100"></div>
        </div>
        <div class="card-footer">
            <div class="row">
                
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
                            <button type="button" id="btn-inquire" class="btn btn-primary">
                                <i class="fas fa-robot"></i>
                            </button>
                        </span>
                    </div>
                
                    
            </div>
        </div>
    </div>
    
</section>
@include('partials.clients.footers')

<script src="{{ asset('scripts/ask-ai.js')}}"></script>

{{-- <script src="{{ asset('scripts/ask-an-expert.js') }}"></script> --}}
{{-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"> --}}