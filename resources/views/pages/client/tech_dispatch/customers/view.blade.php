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
                                :subtitle="'Manage customer locations'"
                                :tools="$tools"
                            >
                                <x-input 
                                    :name="'search_locations'"
                                    :type="'search'"
                                    :placeholder="'Search Locations'"
                                    :data-key="'SearchLocations'"
                                />
                            </x-card>

                            @if($customer['locations'])

                                @foreach($customer['locations'] as $location)
                                    @php
                                        $title = '<i class="fa fa-map-marker"></i> '.$location['location_name'];
                                    @endphp
                                    <x-card
                                        :title="$title"
                                    >
                                    <dl>
                                        <dd>{{ $location['location_name'] }}</dd>
                                        <dd>{{ $location['address'] }}</dd>
                                        <dd>{{ $location['city'] }}</dd>
                                        <dd>{{ $location['state'] }}</dd>
                                        <dd>{{ $location['zip_code'] }}</dd>
                                    </dl>
                                    </x-card>
                                
                                @endforeach

                            @endif
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
            :name="'location_name'"
            :label="'Location Name'"
            :type="'text'"
            :value="''"
            :placeholder="'Location Name'"
            :data-key="'LocationName'"
            :data-req="'req'"
        />
        <x-input
            :name="'address'"
            :label="'Address'"
            :type="'text'"
            :value="''"
            :placeholder="'123 Main Street'"
            :data-key="'Address'"
            :data-req="'req'"
        />
        <x-input
            :name="'city'"
            :label="'City'"
            :type="'text'"
            :value="''"
            :placeholder="'New York'"
            :data-key="'City'"
            :data-req="'req'"
        />
        <x-input
            :name="'state'"
            :label="'State'"
            :type="'text'"
            :value="''"
            :placeholder="'NY'"
            :data-key="'State'"
            :data-req="'req'"
        />
        <x-input
            :name="'zip_code'"
            :label="'Zip Code'"
            :type="'text'"
            :value="''"
            :placeholder="'10001'"
            :data-key="'ZipCode'"
            :data-req="'req'"
        />
        <x-input
            :name="'contact_name'"
            :label="'Contact Name'"
            :type="'text'"
            :value="''"
            :placeholder="'John Doe'"
            :data-key="'ContactName'"
            :data-req="'req'"
        />
        <x-input
            :name="'contact_email'"
            :label="'Contact Email'"
            :type="'email'"
            :value="''"
            :placeholder="'john.doe@example.com'"
            :data-key="'ContactEmail'"
            :data-req="'req'"
        />
        <x-input
            :name="'contact_phone'"
            :label="'Contact Phone'"
            :type="'text'"
            :value="''"
            :placeholder="'1234567890'"
            :data-key="'ContactPhone'"
            :data-req="'req'"
        />

        <x-textarea
            :rows="3"
            :name="'notes'"
            :label="'Notes'"
            :value="''"
            :placeholder="'Notes for the location'"
            :data-key="'Notes'"
            :data-req="''"
            :text="''"
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
                'title' => 'Add Equipment',
                'data-trigger' => 'add-equipment',
                'data-id' => $customer['id'],
            ],
        ],
    ];

    $attrib = [
        'class' => 'modal-dialog modal-dialog-centered modal-lg',
        'id' => 'addEquipmentModal',
    ];
@endphp
<!-- Add Equipment Modal -->
<x-modal
    :title="'Add Equipment'"
    :footer="$footer"
    :tools="$tools"
    :attrib="$attrib"
>
    <x-input
        :name="'equipment_location'"
        :label="'Location'"
        :type="'text'"
        :value="''"
        :placeholder="'Location'"
        :data-key="'equipment_location'"
        :data-req="'req'"
    />
    <x-input
        :name="'equipment_name'"
        :label="'Equipment Name'"
        :type="'text'"
        :value="''"
        :placeholder="'Equipment Name'"
        :data-key="'equipment_name'"
        :data-req="'req'"
    />
    <x-input
        :name="'equipment_type'"
        :label="'Type'"
        :type="'text'"
        :value="''"
        :placeholder="'Type'"
        :data-key="'equipment_type'"
        :data-req="'req'"
    />
    <x-input
        :name="'manufacturer'"
        :label="'Manufacturer'"
        :type="'text'"
        :value="''"
        :placeholder="'Manufacturer'"
        :data-key="'manufacturer'"
        :data-req="'req'"
    />
    <x-input
        :name="'model_number'"
        :label="'Model Number'"
        :type="'text'"
        :value="''"
        :placeholder="'Model Number'"
        :data-key="'model_number'"
        :data-req="'req'"
    />  
    <x-input
        :name="'serial_number'"
        :label="'Serial Number'"
        :type="'text'"
        :value="''"
        :placeholder="'Serial Number'"
        :data-key="'serial_number'"
        :data-req="'req'"
    />
    <x-textarea
        :rows="3"
        :name="'equipment_notes'"
        :label="'Notes'"
        :value="''"
        :placeholder="'Notes'"
        :data-key="'equipment_notes'"
        :data-req="'exclude'"
        :text="''"
    />
</x-modal>




@include('partials.auth.footer')

<script src="{{ asset('assets/acrtfm/js/modules/tech-dispatch/customers.js') }}"></script>