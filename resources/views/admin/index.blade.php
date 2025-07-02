@include('partials.admin.headers')

    <div class="card">
        <div class="card-header">
            <form action="/clients/search" method="GET">
                @csrf
                    {{-- <select class="form-control " name="search_by">
                        <option value="sku" <?=($search_type == "sku" ? " selected" : "");?>>Model Number</option>
                        <option value="brand" <?=($search_type == "brand" ? " selected" : "");?>>Brand Manuals</option>
                    </select>
                    @if ($search_type == "brand")
                        <?php $dis = "";?>
                    @else
                        <?php $dis = " none;";?>
                    @endif --}}
                    {{-- <select class="form-control mt-2" name="brand_name" style="display:<?=$dis;?>">
                        <option value="">Select Brand Name</option>
                        @foreach ($brands as $brand)
                            <option value="{{$brand}}"  <?=(strtoupper($brand) == strtoupper($brand_name) ? " selected" : "");?>>{{strtoupper($brand)}}</option>
                        @endforeach
                    </select> --}}
                    <div id="div-models">
                        <label for="">Model Number:</label>
                        <input autocomplete="off" type="text" value="{{ $search_value }}" id="table_search" name="table_search" class="form-control mt-2 mb-2 float-right" placeholder="Model Number" value="{{ old('table_search') }}">
                    </div>
                    {{-- <button type="submit" class="btn btn-info btn-block">
                        <i class="fas fa-search"></i>
                        Search
                    </button> --}}

            </form>
        </div>
        <div class="card-body">
            <div class="table-responsive p-0" id="div-model-data"></div>
        </div>
        {{-- <div class="card-body">
            <div class=" table-responsive p-0">
                <table class="table text-nowrap">
                    <thead>
                        <tr>
                            <th>Model</th>
                            <th>Brand</th>
                            <th>Link</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($airconditions as $aircondition)
                            <tr>
                                <td>{{ $aircondition->sku }}</td>
                                <td>{{ $aircondition->brand }}</td>
                                <td><a href="{{ $aircondition->url }}" target="_blank" class="text-info">View More</a></td>
                                <td>
                                    <a href="/execute/ac-edit/{{$aircondition->id}}" class="btn btn-primary btn-sm">
                                        <i class="far fa-edit"></i>
                                        Edit
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
                
        </div> --}}
        
        <div class="card-footer">
        
            {{-- <div class="row">
                <div class="col-md-12 d-flex justify-content-center">
                    {{-- {{ $airconditions->links() }}  
                </div>
            </div>
    
            <div class="row mt-4">
                { <div class="col-md-12">
                    
                    <a href="/execute/ac-add" class="btn btn-success btn-block">
                       <i class="fa fa-plus"></i> Add New
                    </a>
                </div> 
            </div> --}}
            
        </div>
    </div>

@include('partials.admin.footers')

<script src="{{ asset('adminlte3.2/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('scripts/admin.js') }}"></script>