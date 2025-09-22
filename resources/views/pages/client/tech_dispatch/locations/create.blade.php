@include('partials.auth.header')

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
                            'name' => 'contact_person',
                            'label' => 'Contact Person',
                            'type' => 'text',
                            'value' => '',
                            'placeholder' => 'Contact Person',
                            'data-key' => 'ContactPerson',
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