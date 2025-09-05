@include('partials.auth.header')


<section class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Work Orders</h4>
                    <p class="card-text">Create, manage and track work orders</p>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <button class="btn btn-primary" type="button">
                                <i class="fa fa-plus me-2"></i>Create Work Order
                            </button>
                            <button class="btn btn-success me-2" type="button">
                                <i class="fa fa-download me-2"></i>Export
                            </button>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <select class="form-select">
                                    <option>All Status</option>
                                    <option>Pending</option>
                                    <option>In Progress</option>
                                    <option>Completed</option>
                                    <option>Cancelled</option>
                                </select>
                                <input type="text" class="form-control" placeholder="Search work orders...">
                                <button class="btn btn-outline-secondary" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Work Order #</th>
                                    <th>Customer</th>
                                    <th>Service Type</th>
                                    <th>Technician</th>
                                    <th>Priority</th>
                                    <th>Status</th>
                                    <th>Created Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#WO-001</td>
                                    <td>John Smith</td>
                                    <td>AC Repair</td>
                                    <td>Mike Johnson</td>
                                    <td><span class="badge badge-warning">High</span></td>
                                    <td><span class="badge badge-primary">In Progress</span></td>
                                    <td>2024-01-15</td>
                                    <td>
                                        <button class="btn btn-sm btn-info me-1">View</button>
                                        <button class="btn btn-sm btn-warning me-1">Edit</button>
                                        <button class="btn btn-sm btn-success">Complete</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#WO-002</td>
                                    <td>Sarah Wilson</td>
                                    <td>Maintenance</td>
                                    <td>David Brown</td>
                                    <td><span class="badge badge-info">Medium</span></td>
                                    <td><span class="badge badge-success">Completed</span></td>
                                    <td>2024-01-14</td>
                                    <td>
                                        <button class="btn btn-sm btn-info me-1">View</button>
                                        <button class="btn btn-sm btn-warning me-1">Edit</button>
                                        <button class="btn btn-sm btn-secondary">Invoice</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#WO-003</td>
                                    <td>Robert Davis</td>
                                    <td>Installation</td>
                                    <td>Lisa Garcia</td>
                                    <td><span class="badge badge-danger">Urgent</span></td>
                                    <td><span class="badge badge-warning">Pending</span></td>
                                    <td>2024-01-16</td>
                                    <td>
                                        <button class="btn btn-sm btn-info me-1">View</button>
                                        <button class="btn btn-sm btn-warning me-1">Edit</button>
                                        <button class="btn btn-sm btn-primary">Assign</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('partials.auth.footer')
