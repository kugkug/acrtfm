@include('partials.auth.header')

<section class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Edit Customer: {{ $customer->full_name }}</h4>
                    <p class="text-muted">Update customer information</p>
                </div>
                <div class="card-body">
                    <form action="{{ route('customers.update', $customer) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <!-- Customer Basic Information -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="border-bottom pb-2 mb-3">Customer Information</h5>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('first_name') is-invalid @enderror" 
                                           id="first_name" name="first_name" value="{{ old('first_name', $customer->first_name) }}" required>
                                    @error('first_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="last_name" class="form-label">Last Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('last_name') is-invalid @enderror" 
                                           id="last_name" name="last_name" value="{{ old('last_name', $customer->last_name) }}" required>
                                    @error('last_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="company" class="form-label">Company</label>
                                    <input type="text" class="form-control @error('company') is-invalid @enderror" 
                                           id="company" name="company" value="{{ old('company', $customer->company) }}">
                                    @error('company')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                           id="email" name="email" value="{{ old('email', $customer->email) }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                           id="phone" name="phone" value="{{ old('phone', $customer->phone) }}" required>
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="country" class="form-label">Country</label>
                                    <select class="form-control @error('country') is-invalid @enderror" 
                                            id="country" name="country">
                                        <option value="USA" {{ old('country', $customer->country) == 'USA' ? 'selected' : '' }}>USA</option>
                                        <option value="Canada" {{ old('country', $customer->country) == 'Canada' ? 'selected' : '' }}>Canada</option>
                                        <option value="Mexico" {{ old('country', $customer->country) == 'Mexico' ? 'selected' : '' }}>Mexico</option>
                                    </select>
                                    @error('country')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <textarea class="form-control @error('address') is-invalid @enderror" 
                                              id="address" name="address" rows="2">{{ old('address', $customer->address) }}</textarea>
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="city" class="form-label">City</label>
                                    <input type="text" class="form-control @error('city') is-invalid @enderror" 
                                           id="city" name="city" value="{{ old('city', $customer->city) }}">
                                    @error('city')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="state" class="form-label">State</label>
                                    <input type="text" class="form-control @error('state') is-invalid @enderror" 
                                           id="state" name="state" value="{{ old('state', $customer->state) }}">
                                    @error('state')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="zip_code" class="form-label">Zip Code</label>
                                    <input type="text" class="form-control @error('zip_code') is-invalid @enderror" 
                                           id="zip_code" name="zip_code" value="{{ old('zip_code', $customer->zip_code) }}">
                                    @error('zip_code')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="notes" class="form-label">Notes</label>
                                    <textarea class="form-control @error('notes') is-invalid @enderror" 
                                              id="notes" name="notes" rows="3">{{ old('notes', $customer->notes) }}</textarea>
                                    @error('notes')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="is_active" value="1" 
                                               id="is_active" {{ old('is_active', $customer->is_active) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">
                                            Active Customer
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('customers.show', $customer) }}" class="btn btn-secondary">
                                        <i class="fa fa-times me-2"></i>Cancel
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-save me-2"></i>Update Customer
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Locations Management -->
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Manage Locations</h5>
                </div>
                <div class="card-body">
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
                    @if($customer->locations->count() == 0)
                        <div class="text-center py-4">
                            <i class="fa fa-map-marker fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No locations added yet.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Equipments Management -->
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Manage Equipments</h5>
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
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

@include('partials.auth.footer')
