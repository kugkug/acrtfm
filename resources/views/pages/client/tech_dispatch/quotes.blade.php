@include('partials.auth.header')


<section class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Quotes Management</h4>
                    <p class="card-text">Generate and manage customer quotes</p>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <button class="btn btn-primary" type="button">
                                <i class="fa fa-plus me-2"></i>Create New Quote
                            </button>
                            <button class="btn btn-success me-2" type="button">
                                <i class="fa fa-file-pdf me-2"></i>Export PDF
                            </button>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <select class="form-select">
                                    <option>All Status</option>
                                    <option>Draft</option>
                                    <option>Sent</option>
                                    <option>Approved</option>
                                    <option>Rejected</option>
                                    <option>Expired</option>
                                </select>
                                <input type="text" class="form-control" placeholder="Search quotes...">
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
                                    <th>Quote #</th>
                                    <th>Customer</th>
                                    <th>Service Description</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Created Date</th>
                                    <th>Expires</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#Q-001</td>
                                    <td>John Smith</td>
                                    <td>AC System Installation</td>
                                    <td>$2,500.00</td>
                                    <td><span class="badge badge-success">Approved</span></td>
                                    <td>2024-01-10</td>
                                    <td>2024-01-25</td>
                                    <td>
                                        <button class="btn btn-sm btn-info me-1">View</button>
                                        <button class="btn btn-sm btn-warning me-1">Edit</button>
                                        <button class="btn btn-sm btn-primary">Convert to WO</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#Q-002</td>
                                    <td>Sarah Wilson</td>
                                    <td>HVAC Maintenance Contract</td>
                                    <td>$1,200.00</td>
                                    <td><span class="badge badge-warning">Sent</span></td>
                                    <td>2024-01-12</td>
                                    <td>2024-01-27</td>
                                    <td>
                                        <button class="btn btn-sm btn-info me-1">View</button>
                                        <button class="btn btn-sm btn-warning me-1">Edit</button>
                                        <button class="btn btn-sm btn-success">Resend</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#Q-003</td>
                                    <td>Robert Davis</td>
                                    <td>Emergency AC Repair</td>
                                    <td>$850.00</td>
                                    <td><span class="badge badge-danger">Expired</span></td>
                                    <td>2024-01-05</td>
                                    <td>2024-01-20</td>
                                    <td>
                                        <button class="btn btn-sm btn-info me-1">View</button>
                                        <button class="btn btn-sm btn-warning me-1">Edit</button>
                                        <button class="btn btn-sm btn-secondary">Renew</button>
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
