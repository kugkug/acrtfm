@include('partials.auth.header')

<section class="container-fluid">
    <div class="row">

        <div class="col-lg-12">
            <ul class="nav nav-pills mb-3 d-flex justify-content-between bg-light">
                <li class="nav-item w-25">
                    <a href="#tab-overview" class="nav-link text-center active" data-toggle="tab" aria-expanded="false">Overview</a>
                </li>
                <li class="nav-item w-25">
                    <a href="#tab-locations" class="nav-link text-center" data-toggle="tab" aria-expanded="false">Locations</a>
                </li>
                <li class="nav-item w-25">
                    <a href="#tab-equipments" class="nav-link text-center" data-toggle="tab" aria-expanded="false">Equipments</a>
                </li>
                <li class="nav-item w-25">
                    <a href="#tab-work-orders" class="nav-link text-center" data-toggle="tab" aria-expanded="true">Word Orders</a>
                </li>
            </ul>
            <div class="tab-content br-n pn">
                <div id="tab-overview" class="tab-pane active">
                    <div class="row">
                        <div class="col-md-12">
                            @php
                                $name = ucwords(strtolower($customer['first_name'] . ' ' . $customer['last_name']));
                                $company = $customer['company'];
                                $email = $customer['email'];
                                $phone = $customer['phone'];
                                $address = $customer['address'];
                                $city = $customer['city'];
                                $state = $customer['state'];
                            @endphp
                            <x-card
                                :title="$name"
                                :hr="true"
                            >
                                <dl>
                                    @if($customer['email'])
                                        <dd><i class="fa fa-envelope mr-2"></i> {{ $customer['email'] }}</dd>
                                    @endif

                                    @if($customer['phone'])
                                        <dd><i class="fa fa-phone mr-2"></i> {{ $customer['phone'] }}</dd>
                                    @endif
                                
                                    @if($customer['address'])
                                        <dd><i class="fa fa-building mr-2"></i> {{ $customer['address'] }}</dd>
                                    @endif

                                    @if($customer['notes'])
                                        <dd><i class="fa fa-sticky-note mr-2"></i> {{ $customer['notes'] }}</dd>
                                    @endif
                                </dl>

                            </x-card>
                        </div>
                    </div>
                </div>
                <div id="tab-locations" class="tab-pane">
                    <div class="row">
                        <div class="col-md-12">
                            @php
                                $tools = [
                                    [
                                        'type' => 'button',
                                        'text' => 'Add Location',
                                        'icon' => 'fa fa-plus',
                                        'attrib' => [
                                            'class' => 'btn btn-info btn-flat btn-sm',
                                            'title' => 'Add Location',
                                            'data-id' => $customer['id'],
                                            'data-trigger' => 'add-location',
                                        ],
                                    ],
                                ];
                            @endphp
                            <x-card
                                :title="'Locations'"
                                :hr="true"
                                :tools="$tools"
                            />
                        </div>
                    </div>
                </div>
                <div id="tab-equipments" class="tab-pane">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            @php
                                $tools = [
                                    [
                                        'type' => 'button',
                                        'text' => 'Add Equipment',
                                        'icon' => 'fa fa-plus',
                                        'attrib' => [
                                            'class' => 'btn btn-info btn-flat btn-sm',
                                            'title' => 'Add Equipment',
                                            'data-id' => $customer['id'],
                                            'data-trigger' => 'add-equipment',
                                        ],
                                    ],
                                ];
                            @endphp
                            <x-card
                                :title="'Equipments'"
                                :hr="true"
                                :tools="$tools"
                            />
                        </div>
                    </div>
                </div>
                <div id="tab-work-orders" class="tab-pane">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <x-card
                                :title="'Work Orders'"
                                :hr="true"
                            />
                        </div>
                    </div>
                </div>
            </div>
            

        </div>
    </div>
</section>

<!-- Add Location Modal -->
<div class="modal fade" id="addLocationModal" tabindex="-1" role="dialog" aria-labelledby="addLocationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form>
            @csrf
            <input type="hidden" name="customer_id" value="{{ $customer['id'] }}">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addLocationModalLabel">Add New Location</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="location_name">Location Name</label>
                        <input type="text" class="form-control" id="location_name" name="location_name" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="city">City</label>
                            <input type="text" class="form-control" id="city" name="city" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="state">State</label>
                            <input type="text" class="form-control" id="state" name="state" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="zip_code">Zip Code</label>
                            <input type="text" class="form-control" id="zip_code" name="zip_code" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="contact_name">Contact Name</label>
                        <input type="text" class="form-control" id="contact_name" name="contact_name">
                    </div>
                    <div class="form-group">
                        <label for="contact_phone">Contact Phone</label>
                        <input type="text" class="form-control" id="contact_phone" name="contact_phone">
                    </div>
                    <div class="form-group">
                        <label for="contact_email">Contact Email</label>
                        <input type="email" class="form-control" id="contact_email" name="contact_email">
                    </div>
                    <div class="form-group">
                        <label for="notes">Notes</label>
                        <textarea class="form-control" id="notes" name="notes" rows="2"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Location</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Add Equipment Modal -->
<div class="modal fade" id="addEquipmentModal" tabindex="-1" role="dialog" aria-labelledby="addEquipmentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="addEquipmentForm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEquipmentModalLabel">Add Equipment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="equipment_location">Location</label>
                        <input type="text" class="form-control" id="equipment_location" name="equipment_location" required>
                    </div>
                    <div class="form-group">
                        <label for="equipment_name">Equipment Name</label>
                        <input type="text" class="form-control" id="equipment_name" name="equipment_name" required>
                    </div>
                    <div class="form-group">
                        <label for="equipment_type">Type</label>
                        <input type="text" class="form-control" id="equipment_type" name="equipment_type" required>
                    </div>
                    <div class="form-group">
                        <label for="manufacturer">Manufacturer</label>
                        <input type="text" class="form-control" id="manufacturer" name="manufacturer">
                    </div>
                    <div class="form-group">
                        <label for="model_number">Model Number</label>
                        <input type="text" class="form-control" id="model_number" name="model_number">
                    </div>
                    <div class="form-group">
                        <label for="serial_number">Serial Number</label>
                        <input type="text" class="form-control" id="serial_number" name="serial_number">
                    </div>
                    <div class="form-group">
                        <label for="equipment_notes">Notes</label>
                        <textarea class="form-control" id="equipment_notes" name="equipment_notes" rows="2"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Equipment</button>
                </div>
            </div>
        </form>
    </div>
</div>




@include('partials.auth.footer')

<script src="{{ asset('assets/acrtfm/js/modules/tech-dispatch/customers.js') }}"></script>