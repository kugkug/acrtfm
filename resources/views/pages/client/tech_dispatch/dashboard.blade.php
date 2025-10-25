@include('partials.auth.header')

@php
    $active_jobs = $dashboard_data['active_jobs'] ?? 0;
    $completed = $dashboard_data['completed'] ?? 0;
    $pending = $dashboard_data['pending'] ?? 0;
    $technicians = $dashboard_data['technicians'] ?? 0;
@endphp
<section class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                
                <div class="card-body">
                    <h4 class="card-title">Tech Dispatch Dashboard</h4>
                    <p class="card-text">Manage and track technical dispatch operations</p>
                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h4 class="text-white">Active Jobs</h4>
                                            <h2 class="text-white">{{ $active_jobs }}</h2>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="fa fa-truck-fast fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h4 class="text-white">Completed</h4>
                                            <h2 class="text-white">{{ $completed }}</h2>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="fa fa-check-circle fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="card bg-warning text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h4 class="text-white">Pending</h4>
                                            <h2 class="text-white">{{ $pending }}</h2>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="fa fa-clock fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="card bg-info text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h4 class="text-white">Technicians</h4>
                                            <h2 class="text-white">{{ $technicians }}</h2>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="fa fa-users fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="row">
        <div class="col-lg-12">
            <div class="card">                
                <div class="card-body">
                    <h4 class="card-title">Recent Work Orders</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Work Order</th>
                                    <th>Customer</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
</section>

@include('partials.auth.footer')
