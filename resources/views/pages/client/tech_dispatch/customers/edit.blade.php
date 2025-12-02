@include('partials.auth.header')

@php
    $footer = [
        [
            'type' => 'button',
            'text' => 'Update Customer',
            'icon' => 'fa fa-save',
            'attrib' => [
                'class' => 'btn btn-success btn-flat',
                'title' => 'Update Customer',
                'data-trigger' => 'update-customer',
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
                            'name' => 'name',
                            'label' => 'Name',
                            'data-key' => 'Name',
                            'data' => '',
                            'class' => 'form-control form-control-sm override-input',
                            'data-validate' => 'name-or-company',
                            'data-default' => $customer['name'],
                            'value' => $customer['name'],
                        ]"  
                    />

                    <x-input 
                        :attrib="[
                            'name' => 'company',
                            'label' => 'Company',
                            'data-key' => 'Company',
                            'data' => '',
                            'class' => 'form-control form-control-sm override-input',
                            'data-validate' => 'name-or-company',
                            'data-default' => $customer['company'],
                            'value' => $customer['company'],
                        ]"
                    />

                    <x-input 
                        :attrib="[
                            'name' => 'phone',
                            'label' => 'Phone',
                            'data-key' => 'PhoneNumber',
                            'data' => 'req',
                            'class' => 'form-control form-control-sm override-input',
                            'data-default' => $customer['phone'],
                            'value' => $customer['phone'],
                        ]"
                    />

                    <x-input 
                        :attrib="[
                            'name' => 'email',
                            'label' => 'Email',
                            'data-key' => 'Email',
                            'data' => 'req',
                            'class' => 'form-control form-control-sm override-input',
                            'data-default' => $customer['email'],
                            'value' => $customer['email'],
                        ]"
                    />

                    <x-textarea 
                        :attrib="[
                            'name' => 'billing_address',
                            'label' => 'Billing Address',
                            'data-key' => 'BillingAddress',
                            'data' => 'req',
                            'class' => 'form-control form-control-sm override-textarea',
                            'data-default' => $customer['address'],
                            'text' => $customer['address'],
                        ]"
                    />
                    <x-textarea 
                        :attrib="[
                            'name' => 'notes',
                            'label' => 'Notes',
                            'data-key' => 'Notes',
                            'class' => 'form-control form-control-sm override-textarea',
                            'data-default' => $customer['notes'],
                            'text' => $customer['notes'],
                        ]"
                    />

                </x-card>
            </form>
        </div>
    </div>
</section>

@include('partials.auth.footer')
<script src="{{ asset('assets/acrtfm/js/modules/tech-dispatch/customers.js') }}"></script>