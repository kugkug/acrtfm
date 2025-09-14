@include('partials.auth.header')

<section class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <!-- Customer Header -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="card-title mb-0">{{ $customer->full_name }}</h4>
                        <p class="text-muted mb-0">{{ $customer->customer_id }}</p>
                    </div>
                    <div>
                        <a href="{{ route('customers.edit', $customer) }}" class="btn btn-warning me-2">
                            <i class="fa fa-edit me-2"></i>Edit
                        </a>
                        <a href="{{ route('customers.index') }}" class="btn btn-secondary">
                            <i class="fa fa-arrow-left me-2"></i>Back to List
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Contact Information</h6>
                            <p><strong>Email:</strong> {{ $customer->email }}</p>
                            <p><strong>Phone:</strong> {{ $customer->phone }}</p>
                            @if($customer->company)
                                <p><strong>Company:</strong> {{ $customer->company }}</p>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <h6>Address</h6>
                            @if($customer->address)
                                <p>{{ $customer->address }}</p>
                                <p>{{ $customer->city }}, {{ $customer->state }} {{ $customer->zip_code }}</p>
                                <p>{{ $customer->country }}</p>
                            @else
                                <p class="text-muted">No address provided</p>
                            @endif
                        </div>
                    </div>
                    @if($customer->notes)
                        <div class="row mt-3">
                            <div class="col-12">
                                <h6>Notes</h6>
                                <p>{{ $customer->notes }}</p>
                            </div>
                        </div>
                    @endif
                    <div class="row mt-3">
                        <div class="col-12">
                            <span class="badge {{ $customer->is_active ? 'bg-success' : 'bg-secondary' }} fs-6">
                                {{ $customer->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Locations Section -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Locations ({{ $customer->locations->count() }})</h5>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addLocationModal">
                        <i class="fa fa-plus me-2"></i>Add Location
                    </button>
                </div>
                <div class="card-body">
                    @if($customer->locations->count() > 0)
                        <div class="row">
                            @foreach($customer->locations as $location)
                                <div class="col-md-6 mb-3">
                                    <div class="card border">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-start mb-2">
                                                <h6 class="card-title mb-0">{{ $location->location_name }}</h6>
                                                @if($location->is_primary)
                                                    <span class="badge bg-primary">Primary</span>
                                                @endif
                                            </div>
                                            <p class="text-muted mb-2">{{ $location->full_address }}</p>
                                            @if($location->contact_person)
                                                <p class="mb-1"><strong>Contact:</strong> {{ $location->contact_person }}</p>
                                            @endif
                                            @if($location->contact_phone)
                                                <p class="mb-1"><strong>Phone:</strong> {{ $location->contact_phone }}</p>
                                            @endif
                                            @if($location->contact_email)
                                                <p class="mb-1"><strong>Email:</strong> {{ $location->contact_email }}</p>
                                            @endif
                                            @if($location->notes)
                                                <p class="mb-0"><strong>Notes:</strong> {{ $location->notes }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fa fa-map-marker fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No locations added yet.</p>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addLocationModal">
                                <i class="fa fa-plus me-2"></i>Add First Location
                            </button>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Equipments Section -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Equipments ({{ $customer->equipments->count() }})</h5>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addEquipmentModal">
                        <i class="fa fa-plus me-2"></i>Add Equipment
                    </button>
                </div>
                <div class="card-body">
                    @if($customer->equipments->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Brand/Model</th>
                                        <th>Location</th>
                                        <th>Installation Date</th>
                                        <th>Warranty</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($customer->equipments as $equipment)
                                        <tr>
                                            <td>
                                                <strong>{{ $equipment->equipment_name }}</strong>
                                                @if($equipment->serial_number)
                                                    <br><small class="text-muted">SN: {{ $equipment->serial_number }}</small>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge bg-info">{{ $equipment->equipment_type }}</span>
                                            </td>
                                            <td>
                                                @if($equipment->brand || $equipment->model)
                                                    {{ $equipment->brand }} {{ $equipment->model }}
                                                @else
                                                    <span class="text-muted">N/A</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($equipment->location)
                                                    {{ $equipment->location->location_name }}
                                                @else
                                                    <span class="text-muted">No location assigned</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($equipment->installation_date)
                                                    {{ $equipment->installation_date->format('M d, Y') }}
                                                @else
                                                    <span class="text-muted">N/A</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($equipment->warranty_expiry)
                                                    {{ $equipment->warranty_expiry }}
                                                @else
                                                    <span class="text-muted">N/A</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($equipment->is_active)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-secondary">Inactive</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fa fa-cogs fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No equipments added yet.</p>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addEquipmentModal">
                                <i class="fa fa-plus me-2"></i>Add First Equipment
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Add Location Modal -->
<div class="modal fade" id="addLocationModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Location</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="addLocationForm">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Location Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="location_name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Contact Person</label>
                                <input type="text" class="form-control" name="contact_person">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Address <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="address" rows="2" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">City <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="city" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">State <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="state" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Zip Code <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="zip_code" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Contact Phone</label>
                                <input type="text" class="form-control" name="contact_phone">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Contact Email</label>
                                <input type="email" class="form-control" name="contact_email">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="is_primary" value="1">
                                    <label class="form-check-label">Primary Location</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Location</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Equipment Modal -->
<div class="modal fade" id="addEquipmentModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Equipment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="addEquipmentForm">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Equipment Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="equipment_name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Equipment Type <span class="text-danger">*</span></label>
                                <select class="form-control" name="equipment_type" required>
                                    <option value="">Select Type</option>
                                    <option value="HVAC">HVAC System</option>
                                    <option value="Generator">Generator</option>
                                    <option value="Chiller">Chiller</option>
                                    <option value="Boiler">Boiler</option>
                                    <option value="Pump">Pump</option>
                                    <option value="Compressor">Compressor</option>
                                    <option value="Fan">Fan</option>
                                    <option value="Motor">Motor</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Brand</label>
                                <input type="text" class="form-control" name="brand">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Model</label>
                                <input type="text" class="form-control" name="model">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Serial Number</label>
                                <input type="text" class="form-control" name="serial_number">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Installation Date</label>
                                <input type="date" class="form-control" name="installation_date">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Warranty Expiry</label>
                                <input type="text" class="form-control" name="warranty_expiry" 
                                       placeholder="e.g., 2 years, 2025-12-31">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Location</label>
                                <select class="form-control" name="customer_location_id">
                                    <option value="">Select Location (Optional)</option>
                                    @foreach($customer->locations as $location)
                                        <option value="{{ $location->id }}">{{ $location->location_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Equipment</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add Location Form
    document.getElementById('addLocationForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        
        fetch(`{{ route('customers.addLocation', $customer) }}`, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error: ' + (data.message || 'Failed to add location'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error adding location');
        });
    });

    // Add Equipment Form
    document.getElementById('addEquipmentForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        
        fetch(`{{ route('customers.addEquipment', $customer) }}`, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error: ' + (data.message || 'Failed to add equipment'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error adding equipment');
        });
    });
});
</script>

@include('partials.auth.footer')
