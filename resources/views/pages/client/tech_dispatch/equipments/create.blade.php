@include('partials.auth.header')

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
            'type' => 'link',
            'text' => 'Cancel',
            'icon' => 'fa fa-times',
            'attrib' => [
                'class' => 'btn btn-danger btn-flat',
                'title' => 'Cancel',
                'href' => redirect()->back()->getTargetUrl(),
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

<section class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <form>
                <x-card 
                    :title="'Location Information'" 
                    :subtitle="'Please provide customer\'s location information'"
                    id="location-information"
                    :footer="$footer"
                    hr="yes"
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
                            'data' => '',
                            'class' => 'form-control form-control-sm override-textarea',
                        ]"
                    />

                </x-card>
            </form>
        </div>
    </div>
</section>

@include('partials.auth.footer')
<script src="{{ asset('assets/acrtfm/js/modules/tech-dispatch/customers.js') }}"></script>

