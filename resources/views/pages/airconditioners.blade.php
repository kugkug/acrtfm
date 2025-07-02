@include('partials.clients.headers')
<section class="container">
    <div class="card">
        <div class="card-header">
            <form action="/clients/search" method="GET">
                @csrf
                    {{-- <label for="">Search By : </label> --}}
                    {{-- <select class="form-control " name="search_by">
                        <option value="sku" <?=//($search_type == "sku" ? " selected" : "");?>>Model Number</option>
                        <option value="brand" <?=//($search_type == "brand" ? " selected" : "");?>>Brand Manuals</option>
                    </select> --}}
                    @if ($search_type == "brand")
                        <?php $dis = "";?>
                    @else
                        <?php $dis = " none;";?>
                    @endif
                    {{-- <select class="form-control mt-2" name="brand_name" style="display:<?=$dis;?>">
                        <option value="">Select Brand Name</option>
                        @foreach ($brands as $brand)
                            <option value="{{$brand}}"  <?=//(strtoupper($brand) == strtoupper($brand_name) ? " selected" : "");?>>{{strtoupper($brand)}}</option>
                        @endforeach
                    </select> --}}
                    <input type="text" value="{{ $search_value }}" name="table_search" class="form-control mt-2 mb-2 float-right" placeholder="Search Input" value="{{ old('table_search') }}">
                    <button type="submit" class="btn btn-info btn-block">
                        <i class="fas fa-search"></i>
                        Search
                    </button>

            </form>
        </div>
        <div class="card-body">

            <div class=" table-responsive p-0">
                <table class="table text-nowrap">
                    <thead>
                        <tr>
                            <th>Model</th>
                            <th>Brand</th>
                            <th>Link</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($airconditions as $aircondition)
                            <tr>
                                <td>{{ $aircondition->sku }}</td>
                                <td>{{ $aircondition->brand }}</td>
                                {{-- $aircondition->url --}}
                                <td>
                                    <a href="javascript:void(0)" target="_blank" data-toggle="modal" data-target="#modal-default" class="btn btn-info" data-object="{{$aircondition}}">
                                        <i class="fa fa-search"></i>
                                        Explore
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="card-footer d-flex justify-content-center">
            {{ $airconditions->links() }} 
        </div>
    </div>

    <div class="modal fade" id="modal-default" aria-modal="true" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Default Modal</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <p>One fine body…</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
<section>
@include('partials.clients.footers')

<script src="{{ asset('adminlte3.2/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('scripts/clients.js') }}"></script>