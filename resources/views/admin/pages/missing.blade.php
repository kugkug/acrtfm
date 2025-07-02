@include('partials.admin.headers')
    
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                

                <div class="card-body">

                    <div class=" table-responsive p-0">
                        <table class="table text-nowrap">
                            <thead>
                                <tr>
                                    <th>Model</th>
                                    <th>Brand</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($missing as $data)
                                <tr>
                                    <td>{{ $data->sku }}</td>
                                    <td>{{ $data->brand }}</td>
                                    
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
        
                    <div class="row">
                        <div class="col-md-12 d-flex justify-content-center">
                            {{ $missing->links() }}    
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>    
    
    
@include('partials.admin.footers')

<script src="{{ asset('scripts/modules/admin/modules.js') }}"></script>