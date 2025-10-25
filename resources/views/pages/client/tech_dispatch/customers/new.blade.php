@include('partials.auth.header')

@php
    $footer = [
        [
            'type' => 'button',
            'text' => 'Save Customer',
            'icon' => 'fa fa-save',
            'attrib' => [
                'class' => 'btn btn-success btn-flat',
                'title' => 'Save Customer',
                'data-trigger' => 'save-customer',
            ],
        ],
        [
            'type' => 'button',
            'text' => 'Cancel',
            'icon' => 'fa fa-times',
            'attrib' => [
                'class' => 'btn btn-danger btn-flat',
                'title' => 'Cancel',
                'data-trigger' => 'cancel-customer',
            ],
        ]
    ];
@endphp
<section class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <form>
                <x-card 
                    :title="'Customer Information'" 
                    :subtitle="'Please provide customer information'"
                    id="customer-information"
                    :footer="$footer"
                    hr="yes"
                >
                    <x-input 
                        :attrib="[
                            'name' => 'company',
                            'label' => 'Company',
                            'data-key' => 'Company',
                            'data' => '',
                            'class' => 'form-control form-control-sm override-input',
                        ]"
                    />
                    <x-input 
                        :attrib="[
                            'name' => 'first_name',
                            'label' => 'First Name',
                            'data-key' => 'FirstName',
                            'data' => 'req',
                            'class' => 'form-control form-control-sm override-input',
                        ]"  
                    />
                    <x-input 
                        :attrib="[
                            'name' => 'last_name',
                            'label' => 'Last Name',
                            'data-key' => 'LastName',
                            'data' => 'req',
                            'class' => 'form-control form-control-sm override-input',
                        ]"                            
                    />

                    <x-input 
                        :attrib="[
                            'name' => 'phone',
                            'label' => 'Phone',
                            'data-key' => 'PhoneNumber',
                            'data' => '',
                            'class' => 'form-control form-control-sm override-input',
                        ]"
                    />

                    <x-input 
                        :attrib="[
                            'name' => 'email',
                            'label' => 'Email',
                            'data-key' => 'Email',
                            'data' => 'req',
                            'class' => 'form-control form-control-sm override-input',
                        ]"
                    />

                    <x-textarea 
                        :attrib="[
                            'name' => 'billing_address',
                            'label' => 'Billing Address',
                            'data-key' => 'BillingAddress',
                            'data' => '',
                            'class' => 'form-control form-control-sm override-textarea',
                        ]"
                    />
                    <x-textarea 
                        :attrib="[
                            'name' => 'notes',
                            'label' => 'Notes',
                            'data-key' => 'Notes',
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