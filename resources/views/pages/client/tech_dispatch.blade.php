@include('partials.auth.header')
<section class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Tech Dispatch Dashboard</h4>
                    <p class="card-text">Manage and track technical dispatch operations</p>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h4 class="text-white">Active Jobs</h4>
                                            <h2 class="text-white">0</h2>
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
                                            <h2 class="text-white">0</h2>
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
                                            <h2 class="text-white">0</h2>
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
                                            <h2 class="text-white">0</h2>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="fa fa-users fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mt-4">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Recent Dispatch Jobs</h5>
                                </div>
                                <div class="card-body">
                                    {{-- <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Job ID</th>
                                                    <th>Customer</th>
                                                    <th>Location</th>
                                                    <th>Technician</th>
                                                    <th>Status</th>
                                                    <th>Priority</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>#TD-001</td>
                                                    <td>John Smith</td>
                                                    <td>123 Main St</td>
                                                    <td>Mike Johnson</td>
                                                    <td><span class="badge badge-primary">In Progress</span></td>
                                                    <td><span class="badge badge-warning">High</span></td>
                                                </tr>
                                                <tr>
                                                    <td>#TD-002</td>
                                                    <td>Sarah Wilson</td>
                                                    <td>456 Oak Ave</td>
                                                    <td>David Brown</td>
                                                    <td><span class="badge badge-success">Completed</span></td>
                                                    <td><span class="badge badge-info">Medium</span></td>
                                                </tr>
                                                <tr>
                                                    <td>#TD-003</td>
                                                    <td>Robert Davis</td>
                                                    <td>789 Pine Rd</td>
                                                    <td>Lisa Garcia</td>
                                                    <td><span class="badge badge-warning">Pending</span></td>
                                                    <td><span class="badge badge-danger">Urgent</span></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-lg-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Quick Actions</h5>
                                </div>
                                <div class="card-body">
                                    <div class="d-grid gap-2">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fa fa-plus me-2"></i>Create New Dispatch
                                        </button>
                                        <button class="btn btn-success" type="button">
                                            <i class="fa fa-user-plus me-2"></i>Assign Technician
                                        </button>
                                        <button class="btn btn-info" type="button">
                                            <i class="fa fa-map-marker-alt me-2"></i>View Map
                                        </button>
                                        <button class="btn btn-warning" type="button">
                                            <i class="fa fa-chart-bar me-2"></i>Generate Report
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('partials.auth.footer')
