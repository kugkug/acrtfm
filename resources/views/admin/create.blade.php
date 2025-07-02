@include('partials.admin.headers')
<div class="row">
    
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fa-solid fa-clipboard-user"></i>
                    Information
                </h3>
            </div>

            <form action="/execute/ac-save" method="POST">
                @csrf
                
                <div class="card-body">
                    @if(session()->has('message'))
                        <h4 class="text-success">{{session('message')}}</h4>
                    @endif

                    @if(session()->has('error_message'))
                        <h4 class="text-danger">{{session('error_message')}}</h4>
                    @endif
                    <div class="form-group">
                        <label for="email" class="d-flex justify-content-between">
                            <span>Brand</span> 
                            <a href="javascript:void(0)" class="btn btn-info btn-sm" data-trigger="brand">
                                <span data-type="add">
                                    <i class="fa fa-plus"></i>
                                </span>                                
                            </a>
                        </label>
                        <input type="text" name="brand" class="form-control " placeholder="Brand" style="display: none;" value="MITSUBISHI">
                        <select class="form-control mt-2" name="select_brand">
                            <option value="">Select Brand Name</option>
                            @foreach ($brands as $brand)
                                <?php
                                    $selected = "";
                                    if (strtolower($brand) === "mitsubishi")
                                        $selected = " selected";
                                
                                ?>
                                <option value="{{$brand}}" {{ $selected }} >{{strtoupper($brand)}}</option>
                            @endforeach
                        </select>
                    </div>

                    
                    <div class="form-group">
                        <label for="name">Model</label>
                        <input type="text" name="sku" class="form-control " placeholder="Model">
                    </div>
                    
                    <hr></hr>

                    <h3>Information Links</h3>
                    <hr></hr>
                    <div class="form-group">
                        <label for="password">Model Link</label>
                        <input type="text" name="model_link" class="form-control " placeholder="Model Link">
                    </div>
                    <div class="form-group">
                        <label for="password">Installation Manual Link</label>
                        <input type="text" name="installation_manual" class="form-control " placeholder="Installation Manual Link">
                    </div>
                    <div class="form-group">
                        <label for="password">Operation Manual Link</label>
                        <input type="text" name="operation_manual" class="form-control " placeholder="Operation Manual Link">
                    </div>
                    <div class="form-group">
                        <label for="password">Parts Manual Link</label>
                        <input type="text" name="parts_manual" class="form-control " placeholder="Parts Manual Link">
                    </div>
                    <div class="form-group">
                        <label for="password">Service Manual Link</label>
                        <input type="text" name="service_manual" class="form-control " placeholder="Service Manual Link">
                    </div>
                    <div class="form-group">
                        <label for="password">M&P Troubleshooter Link</label>
                        <input type="text" name="m_p_troubleshooter" class="form-control " placeholder="M&P Troubleshooter Link">
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row justify-content-between">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-plus"></i>
                            Add
                        </button>

                        <a href="/admin/dashboard" class="btn btn-danger">
                            <i class="fa fa-undo"></i>
                            Back To List
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@include('partials.admin.footers')

<script src="{{ asset('adminlte3.2/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('scripts/create.js') }}"></script>