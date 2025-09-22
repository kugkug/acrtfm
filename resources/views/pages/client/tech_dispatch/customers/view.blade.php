@include('partials.auth.header')

@php
    
    $is_locations_active = "";
    $is_equipments_active = "";
    $is_work_orders_active = "";
    $is_overview_active = "";

    if (in_array($tab, ['locations', 'equipments', 'work-orders'])) {
        $is_locations_active = $tab == 'locations' ? 'active' : '';
        $is_equipments_active = $tab == 'equipments' ? 'active' : '';
        $is_work_orders_active = $tab == 'work-orders' ? 'active' : '';
    } else {
        $is_overview_active = "active";
    }
     
    
@endphp
<section class="container-fluid">
    <div class="row">

        <div class="col-lg-12">
            <ul class="nav nav-pills mb-3 d-flex justify-content-between bg-light">
                <li class="nav-item w-25">
                    <a href="#tab-overview" class="nav-link text-center {{$is_overview_active}}" data-toggle="tab" aria-expanded="false">Overview</a>
                </li>
                <li class="nav-item w-25">
                    <a href="#tab-locations" class="nav-link text-center {{$is_locations_active}}" data-toggle="tab" aria-expanded="false">Locations</a>
                </li>
                <li class="nav-item w-25">
                    <a href="#tab-equipments" class="nav-link text-center {{$is_equipments_active}}" data-toggle="tab" aria-expanded="false">Equipments</a>
                </li>
                <li class="nav-item w-25">
                    <a href="#tab-work-orders" class="nav-link text-center {{$is_work_orders_active}}" data-toggle="tab" aria-expanded="true">Work Orders</a>
                </li>
            </ul>
            <div class="tab-content br-n pn">
                <div id="tab-overview" class="tab-pane {{$is_overview_active}}">
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

                                $tools = [
                           
                                    [
                                        'type' => 'link',
                                        'text' => '',
                                        'icon' => 'fa fa-edit',
                                        'attrib' => [
                                            'class' => 'btn btn-default btn-sm text-warning',
                                            'title' => 'Edit',
                                            'href' => route('customers.edit', $customer['id']),
                                        ],
                                    ],
                                    [
                                        'type' => 'button',
                                        'text' => '',
                                        'icon' => 'fa fa-trash',
                                        'attrib' => [
                                            'class' => 'btn  btn-default btn-sm text-danger',
                                            'title' => 'Delete',
                                            'data-trigger' => 'delete-customer',
                                            'data-id' => $customer['id'],
                                        ],
                                    ],
                                ];
                            @endphp
                            <x-card
                                :title="$name"
                                :hr="true"
                                :tools="$tools"
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
                <div id="tab-locations" class="tab-pane {{$is_locations_active}}">
                    <div class="row">
                        <div class="col-md-12">
                            @php
                                $tools = [
                                    [
                                        'type' => 'link',
                                        'text' => 'Add Location',
                                        'icon' => 'fa fa-plus',
                                        'attrib' => [
                                            'href' => route('locations.create', $customer['id']),
                                            'class' => 'btn btn-info btn-flat',
                                            // 'title' => 'Add Location',
                                            // 'data-id' => $customer['id'],
                                            // 'data-trigger' => 'add-location',
                                        ],
                                    ],
                                ];
                            @endphp

                            <x-card
                                :title="'Locations'"
                                :subtitle="'Manage customer locations'"
                                :tools="$tools"
                                :hr="true"
                            >
                                <x-input 
                                    :attrib="[
                                        'name' => 'search_locations',
                                        'type' => 'search',
                                        'placeholder' => 'Search Locations',
                                        'data-key' => 'SearchLocations',
                                        'class' => 'form-control form-control-sm override-input',
                                    ]"
                                />
                            </x-card>

                            @if($customer['locations'])
                                @foreach($customer['locations'] as $location)

                                    @php
                                        $title = '<i class="fa fa-map-marker"></i> '.$location['location_name'];

                                        $tools = [
                                            [
                                                'type' => 'link',
                                                'text' => '',
                                                'icon' => 'fa fa-edit',
                                                'attrib' => [
                                                    'href' => route('locations.edit', $location['id']),
                                                    'class' => 'btn btn-default btn-flat text-warning',
                                                ],
                                            ],
                                            [
                                                'type' => 'button',
                                                'text' => '',
                                                'icon' => 'fa fa-trash',
                                                'attrib' => [
                                                    'data-trigger' => 'delete-location',
                                                    'data-id' => $location['id'],
                                                    'class' => 'btn btn-default btn-flat text-danger',
                                                ],
                                                
                                            ],
                                        ];
                                    @endphp
                                    <x-card
                                        :title="$title"
                                        :hr="true"
                                        :tools="$tools"
                                    >

                                        <dl>
                                            <dd>
                                                <i class="fa fa-user"></i> {{ ucwords(strtolower($location['contact_person'])) }}, 
                                                <i class="fa fa-envelope"></i> {{ $location['contact_email'] }},
                                                <i class="fa fa-phone"></i> {{ $location['contact_phone'] }}
                                            </dd>
                                            <dd>
                                                <i class="fa fa-building"></i> {{ $location['address'] }}, 
                                                <i class="fa fa-city"></i> {{ $location['city'] }}, 
                                                <i class="fa fa-state"></i> {{ $location['state'] }},
                                                <i class="fa fa-zip"></i> {{ $location['zip_code'] }}
                                            </dd>
                                            <dd>
                                                <i class="fa fa-sticky-note"></i> {{ $location['notes'] }}
                                            </dd>   
                                            
                                        </dl>

                                    </x-card>

                                @endforeach
                            @else
                                <div class="alert alert-danger">
                                    No Locations
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div id="tab-equipments" class="tab-pane {{$is_equipments_active}}">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            @php
                                $tools = [
                                    [
                                        'type' => 'link',
                                        'text' => 'Add Equipment',
                                        'icon' => 'fa fa-plus',
                                        'attrib' => [
                                            'href' => route('equipments.create', $customer['id']),
                                            'class' => 'btn btn-info btn-flat',
                                        ],
                                    ],
                                ];
                            @endphp
                            <x-card
                                :title="'Equipments'"
                                :subtitle="'Manage customer equipments'"
                                :hr="true"
                                :tools="$tools"
                            >
                                <x-input 
                                    :attrib="[
                                        'name' => 'search_equipments',
                                        'type' => 'search',
                                        'placeholder' => 'Search Equipments',
                                        'data-key' => 'SearchEquipments',
                                        'class' => 'form-control form-control-sm override-input',
                                    ]"
                                />
                            </x-card>

                            @if($customer['equipments'])
                                @foreach($customer['equipments'] as $equipment)
                                    @php
                                        $title = '<i class="fa fa-wrench"></i> '.$equipment['equipment_name'];

                                        $tools = [
                                            [
                                                'type' => 'link',
                                                'text' => '',
                                                'icon' => 'fa fa-edit',
                                                'attrib' => [
                                                    'href' => route('equipments.edit', $equipment['id']),
                                                    'class' => 'btn btn-default btn-flat text-warning',
                                                ],
                                            ],
                                            [
                                                'type' => 'button',
                                                'text' => '',
                                                'icon' => 'fa fa-trash',
                                                'attrib' => [
                                                    'data-trigger' => 'delete-equipment',
                                                    'data-id' => $equipment['id'],
                                                    'class' => 'btn btn-default btn-flat text-danger',
                                                ],
                                            ],
                                        ];
                                    @endphp
                                    <x-card
                                        :title="$title"
                                        :hr="true"
                                        :tools="$tools"
                                    >
                                        <dl>
                                            <dd>{{ $equipment['equipment_name'] }}</dd>
                                            <dd>{{ $equipment['equipment_type']['type'] }}</dd>
                                            <dd>{{ $equipment['brand'] }}</dd>
                                            <dd>{{ $equipment['model'] }}</dd>
                                            <dd>{{ $equipment['serial_number'] }}</dd>
                                            <dd>{{ $equipment['notes'] }}</dd>
                                        </dl>
                                    </x-card>
                                @endforeach
                            @else
                                <div class="alert alert-danger">
                                    No Equipments
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div id="tab-work-orders" class="tab-pane {{$is_work_orders_active}}">
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
{{-- 
@php
    $footer = [
        [
            'type' => 'button',
            'text' => 'Save Location',
            'icon' => 'fa fa-save',
            'attrib' => [
                'class' => 'btn btn-success btn-flat',
                'title' => 'Save Location',
                'data-trigger' => 'save-location',
                'data-id' => $customer['id'],
            ],
        ],
        [
            'type' => 'button',
            'text' => 'Cancel',
            'icon' => 'fa fa-times',
            'attrib' => [
                'class' => 'btn btn-danger btn-flat',
                'title' => 'Cancel',
                'data-trigger' => 'cancel-add-location',
            ],
        ]
    ];

    $tools = [];

    $attrib = [
        'class' => 'modal-dialog modal-dialog-centered modal-lg',
        'id' => 'addLocationModal',
    ];
@endphp
<x-modal
    :title="'Add Location'"
    :footer="$footer"
    :tools="$tools"
    :attrib="$attrib"
>
        <x-input
            :attrib="[
                'name' => 'location_name',
                'label' => 'Location Name',
                'type' => 'text',
                'value' => '',
                'placeholder' => 'Location Name',
                'data-key' => 'LocationName',
                'data' => 'req',
                'class' => 'form-control form-control-sm override-input',
            ]"
        /> 
        <x-input
            :attrib="[
                'name' => 'address',
                'label' => 'Address',
                'type' => 'text',
                'value' => '',
                'placeholder' => 'Address',
                'data-key' => 'Address',
                'data' => 'req',
                'class' => 'form-control form-control-sm override-input',
            ]"
        />
        <x-input
            :attrib="[
                'name' => 'city',
                'label' => 'City',
                'type' => 'text',
                'value' => '',
                'placeholder' => 'City',
                'data-key' => 'City',
                'data' => 'req',
                'class' => 'form-control form-control-sm override-input',
            ]"
        />

        <x-input
            :attrib="[
                'name' => 'state',
                'label' => 'State',
                'type' => 'text',
                'value' => '',
                'placeholder' => 'State',
                'data-key' => 'State',
                'data' => 'req',
                'class' => 'form-control form-control-sm override-input',
            ]"

        />
        <x-input
            :attrib="[
                'name' => 'zip_code',
                'label' => 'Zip Code',
                'type' => 'text',
                'value' => '',
                'placeholder' => 'Zip Code',
                'data-key' => 'ZipCode',
                'data' => 'req',
                'class' => 'form-control form-control-sm override-input',
            ]"
        />
        
        <x-input
            :attrib="[
                'name' => 'contact_name',
                'label' => 'Contact Name',
                'type' => 'text',
                'value' => '',
                'placeholder' => 'Contact Name',
                'data-key' => 'ContactName',
                'data' => 'req',
                'class' => 'form-control form-control-sm override-input',
            ]"
        />

        <x-input
            :attrib="[
                'name' => 'contact_email',
                'label' => 'Contact Email',
                'type' => 'email',
                'value' => '',
                'placeholder' => 'Contact Email',
                'data-key' => 'ContactEmail',
                'data' => 'req',
                'class' => 'form-control form-control-sm override-input',
            ]"
        />

        <x-input
            :attrib="[
                'name' => 'contact_phone',
                'label' => 'Contact Phone',
                'type' => 'text',
                'value' => '',
                'placeholder' => 'Contact Phone',
                'data-key' => 'ContactPhone',
                'data' => 'req',
                'class' => 'form-control form-control-sm override-input',
            ]"
        
        />

        <x-textarea
            :attrib="[  

                'text' => '',
                'name' => 'notes',
                'label' => 'Notes',
                'rows' => '3',
                
                'placeholder' => 'Notes for the location',
                'data-key' => 'Notes',
                'data' => 'exclude',
                'class' => 'form-control form-control-sm override-textarea',
            ]"
        />
</x-modal>

@php
    $footer = [
        [
            'type' => 'button',
            'text' => 'Add Equipment',
            'icon' => 'fa fa-plus',
            'attrib' => [
                'class' => 'btn btn-success btn-flat',
                'title' => 'Save Equipment',
                'data-trigger' => 'save-equipment',
                'data-id' => $customer['id'],
            ],
        ],
        [
            'type' => 'button',
            'text' => 'Cancel',
            'icon' => 'fa fa-times',
            'attrib' => [
                'class' => 'btn btn-danger btn-flat',
                'title' => 'Cancel',
                'data-trigger' => 'cancel-add-equipment',
            ],
        ]
    ];

    $attrib = [
        'class' => 'modal-dialog modal-dialog-centered modal-lg',
        'id' => 'addEquipmentModal',
    ];

    $locations = [];

    foreach ($customer['locations'] as $location) {
        $locations[] = [
            'id' => $location['id'],
            'label' => $location['location_name'],
        ];
    }

    $equip_types = [];
    foreach ($equipment_types as $equipment_type) {
        $equip_types[] = [
            'id' => $equipment_type['id'],
            'label' => $equipment_type['type'],
        ];
    }
@endphp
<!-- Add Equipment Modal -->
<x-modal
    :title="'Add Equipment'"
    :footer="$footer"
    :tools="$tools"
    :attrib="$attrib"
>
    <x-select
        :attrib="[
            'id' => 'equipment_location',
            'name' => 'equipment_location',
            'data-key' => 'EquipmentLocation',
            'data' => 'req',
            'class' => 'form-control form-control-sm override-select',
        ]"
        :options="$locations"
        :label="'Location'"
    />

    <x-input
        :attrib="[
            'name' => 'equipment_name',
            'label' => 'Equipment Name',
            'type' => 'text',
            'value' => '',
            'placeholder' => 'Equipment Name',
            'data-key' => 'EquipmentName',
            'data' => 'req',
            'class' => 'form-control form-control-sm override-input',
        ]"
    />
    <x-select
        :attrib="[
            'id' => 'equipment_type_id',
            'name' => 'equipment_type_id',
            'data-key' => 'EquipmentTypeId',
            'data' => 'req',
            'class' => 'form-control form-control-sm override-select',
        ]"
        :options="$equip_types"
        :label="'Type'"
    />
    <x-input
        :attrib="[
            'name' => 'manufacturer',
            'label' => 'Manufacturer',
            'type' => 'text',
            'value' => '',
            'placeholder' => 'Manufacturer',
            'data-key' => 'Manufacturer',
            'data' => 'req',
            'class' => 'form-control form-control-sm override-input',
        ]"
    />
    <x-input
        :attrib="[
            'name' => 'model_number',
            'label' => 'Model Number',
            'type' => 'text',
            'value' => '',
            'placeholder' => 'Model Number',
            'data-key' => 'ModelNumber',
            'data' => 'req',
            'class' => 'form-control form-control-sm override-input',
        ]"
    />


    <x-input
        :attrib="[
            'name' => 'serial_number',
            'label' => 'Serial Number',
            'type' => 'text',
            'value' => '',
            'placeholder' => 'Serial Number',
            'data-key' => 'SerialNumber',
            'data' => 'req',
            'class' => 'form-control form-control-sm override-input',
        ]"
    />
    <x-textarea
        :attrib="[  
            'rows' => '3',
            'name' => 'equipment_notes',
            'label' => 'Notes',
            'text' => '',
            'placeholder' => 'Notes',
            'data-key' => 'EquipmentNotes',
            'data' => 'exclude',
            'class' => 'form-control form-control-sm override-textarea',
        ]"
    />
</x-modal> --}}

@include('partials.auth.footer')

<script src="{{ asset('assets/acrtfm/js/modules/tech-dispatch/customers.js') }}"></script>