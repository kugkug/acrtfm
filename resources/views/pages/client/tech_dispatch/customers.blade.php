@include('partials.auth.header')

<section class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Customer Management</h4>
                    <p class="card-text">Manage customer information and relationships</p>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <button class="btn btn-primary" type="button">
                                <i class="fa fa-plus me-2"></i>Add New Customer
                            </button>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search customers...">
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
                                    <th>Customer ID</th>
                                    <th>Name</th>
                                    <th>Company</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Location</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#CUST-001</td>
                                    <td>John Smith</td>
                                    <td>Smith Industries</td>
                                    <td>john@smithindustries.com</td>
                                    <td>(555) 123-4567</td>
                                    <td>New York, NY</td>
                                    <td>
                                        <button class="btn btn-sm btn-info me-1">View</button>
                                        <button class="btn btn-sm btn-warning me-1">Edit</button>
                                        <button class="btn btn-sm btn-success">Quote</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#CUST-002</td>
                                    <td>Sarah Wilson</td>
                                    <td>Wilson Corp</td>
                                    <td>sarah@wilsoncorp.com</td>
                                    <td>(555) 987-6543</td>
                                    <td>Los Angeles, CA</td>
                                    <td>
                                        <button class="btn btn-sm btn-info me-1">View</button>
                                        <button class="btn btn-sm btn-warning me-1">Edit</button>
                                        <button class="btn btn-sm btn-success">Quote</button>
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
