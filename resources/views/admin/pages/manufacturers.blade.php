@include('partials.admin.headers')
    <div class="row">
        <div class="col-md-12">
            <form action="" role="form" enctype="multipart/form-data">
                <div class="card">
                    <div class="card-body">
                        <label for="">Manufacturer:</label>
                        <select class="form-control mt-2" name="brand_name">
                            <option value="">Select Brand Name</option>
                            @foreach ($brands as $brand)
                            <option value="{{$brand}}" data-image="{{ asset('images/brand_logos/'.strtolower($brand).'.jpg') }}">{{strtoupper($brand)}}</option>
                            @endforeach
                        </select>

                        <div class="div-image mt-2 d-none div-brand-logo" id="div-brand-logo"></div>
                        <input type="file" id="file-image" style="display:none;">
                    </div>
                    <div class="card-footer d-none div-brand-logo">
                        <button class="btn btn-primary btn-block" id="btn-update" disabled> UPDATE</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@include('partials.admin.footers')

<script src="{{ asset('scripts/modules/admin/manufacturer.js') }}"></script>