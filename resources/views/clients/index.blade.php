@include('partials.clients.headers')
<section class="container">
    <div class="card">
        <div class="card-header">
            <form action="/airconditioners/search" method="GET">
                @csrf
                <select class="form-control mt-2 d-none" name="brand_name" id="brand_name">
                    <option value="">Select Brand Name</option>
                    @foreach ($brands as $brand)
                        <option value="{{$brand}}"  <?=(strtoupper($brand) == strtoupper($brand_name) ? " selected" : "");?>>{{strtoupper($brand)}}</option>
                    @endforeach
                </select>


                <div id="div-models">
                    <label for="">Model Number:</label>
                    <input autocomplete="off" type="text" value="{{ $search_value }}" id="table_search" name="table_search" class="form-control mt-2 mb-2 float-right" placeholder="Model Number" value="{{ old('table_search') }}">
                </div>
            </form>
        </div>
        <div class="card-body">
            <div class="table-responsive p-0" id="div-model-data"></div>
        </div>
    </div>

    <div class="modal fade" id="modelModal" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle"></h5>
                    <div class="card-tools">
                        <a class="btn btn-warning" href="#" target='_blank' id="btnFullScreen">
                            <i class="fas fa-expand"></i>
                            Full Screen
                        </a>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    
                </div>
                <div class="modal-body">
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

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="missingModelModal" aria-modal="true" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">
                        Report Missing Model
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                     

                    <div class="form-group">
                        <label for="txtMissingModel">Model</label>
                        <input type="text" class="form-control" id="txtMissingModel" placeholder="Model No.">
                    </div>

                    <div class="form-group">
                        <label for="selMissingModelBrand">Manufacturers</label>
                        <select class="form-control mt-2" id="selMissingModelBrand">
                            <option value="">Select Manufacturer</option>
                            
                            @foreach ($brands as $brand)
                                <option value="{{$brand}}"  <?=(strtoupper($brand) == strtoupper($brand_name) ? " selected" : "");?>>{{strtoupper($brand)}}</option>
                            @endforeach
                            <option value="new_brand">Add Manufacturer</option>
                        </select>
                    </div>
                    <div class="form-group d-none" id="div-missing-brand">
                        <label for="txtMissingBrand">New Manufacturer</label>
                        <input type="text" class="form-control" id="txtMissingBrand" placeholder="Manufacturer for Missing Model">
                    </div>
                    <div class="form-group">
                        <label for="txtLink">Model Link</label>
                        <input type="text" class="form-control" id="txtLink" placeholder="Link for Missing Model">
                    </div>
                    <div class="form-group">
                        <label for="txtPdfLink">Product Manual Link</label>
                        <input type="text" class="form-control" id="txtPdfLink" placeholder="Product Manual Link">
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary" data-trigger="report">
                        <i class="fas fa-bug"></i> Report
                    </button>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" value="{{ config('system.manual_url') }}/manuals" id="txtManualPath">
</section>
@include('partials.clients.footers')
{{-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"> --}}

<script src="{{ asset('scripts/clients.js') }}"></script>