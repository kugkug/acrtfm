@include('partials.admin.headers')
    
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                

                <div class="card-body">

                    <div class=" table-responsive p-0">
                        <table class="table text-nowrap">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($techs as $tech)        
                                <tr>
                                    <td>{{ $tech->name }}</td>
                                    <td>{{ $tech->email }}</td>
                                    <td>{{ ($tech->status) ? ucfirst($tech->status) : 'Active' }}</td>
                                    <td>
                                        <div class="d-flex">
                                        @if ($tech->status !== "blocked")
                                            <form action="/admin/execute/block-user" method="post">
                                                @csrf
                                                <input type="hidden" value="{{$tech->id}}" name="tech_id">
                                                <button type="submit" class="btn btn-warning btn-sm">
                                                    <i class="fa fa-user-slash"></i>
                                                    Block
                                                </button>
                                            </form>
                                            @else
                                            <form action="/admin/execute/activate-user" method="post">
                                                @csrf
                                                <input type="hidden" value="{{$tech->id}}" name="tech_id">
                                                <button type="submit" class="btn btn-success btn-sm">
                                                    <i class="fas fa-user-check"></i>
                                                    Activate
                                                </button>
                                            </form>

                                        @endif
                                        
                                        <form action="/admin/execute/delete-user" method="post" class="ml-2">
                                            @csrf
                                            <input type="hidden" value="{{$tech->id}}" name="tech_id">
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-user-times"></i>
                                                Remove
                                            </button>
                                        </form>

                                        @if($tech->user_type == "client")
                                            <form action="/admin/execute/make-admin" method="post" class="ml-2">
                                                @csrf
                                                <input type="hidden" value="{{$tech->id}}" name="tech_id">
                                                <button type="submit" class="btn btn-info btn-sm">
                                                    <i class="fas fa-user-tie"></i>
                                                    Make Admin
                                                </button>
                                            </form>
                                        @else
                                            <form action="/admin/execute/make-user" method="post" class="ml-2">
                                                @csrf
                                                <input type="hidden" value="{{$tech->id}}" name="tech_id">
                                                <button type="submit" class="btn btn-secondary btn-sm">
                                                    <i class="fas fa-user"></i>
                                                    Make User
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
        
                    <div class="row">
                        <div class="col-md-12 d-flex justify-content-center">
                            {{ $techs->links() }}    
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>    
    
    
@include('partials.admin.footers')

<script src="{{ asset('scripts/modules/admin/modules.js') }}"></script>