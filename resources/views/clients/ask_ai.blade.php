@include('partials.clients.headers')
<section class="container">
    <div class="card mb-2">
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
                        <button type="button" id="btn-inquire" class="btn btn-primary">Ask A.I.</button>
                    </span>
                </div>
            </div>
        </div>
        <div class="card-body" id="div-result"></div>
    </div>
    
</section>
@include('partials.clients.footers')

<script src="{{ asset('scripts/ask-ai.js')}}"></script>

{{-- <script src="{{ asset('scripts/ask-an-expert.js') }}"></script> --}}
{{-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"> --}}