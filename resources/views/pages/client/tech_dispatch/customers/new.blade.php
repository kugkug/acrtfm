@include('partials.auth.header')

@php
    $footer = implode(',', [
        'Save Customer|save-customer|btn-success|fa fa-save',
        'Cancel|cancel-customer|btn-secondary|fa fa-times'
    ]);
@endphp
<section class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <form>
                <x-card 
                    title="Customer Information" 
                    subtitle="Please provide customer information"
                    id="customer-information"
                    footer="{{ $footer }}"
                    hr="yes"
                >
                    <x-input 
                        name="company" 
                        label="Company" 
                        dataKey="Company"
                        dataReq="req"
                    />
                    <x-input 
                        name="first_name" 
                        label="First Name" 
                        dataKey="FirstName"
                        dataReq="req"
                    />
                    
                    <x-input 
                        name="last_name" 
                        label="Last Name" 
                        dataKey="LastName"
                        dataReq="req"
                    />

                    <x-input 
                        name="phone" 
                        label="Phone" 
                        dataKey="PhoneNumber"
                        dataReq="req"
                    />

                    <x-input 
                        name="email" 
                        label="Email" 
                        dataKey="Email"
                        dataReq="req"
                    />

                    <x-textarea 
                        name="billing_address" 
                        label="Billing Address" 
                        dataKey="BillingAddress"
                        dataReq="req"
                        rows="3"
                    />

                    <x-textarea 
                        name="notes" 
                        label="Notes" 
                        dataKey="Notes"
                        rows="3"
                        text=""
                    />

                </x-card>
            </form>
        </div>
    </div>
</section>

@include('partials.auth.footer')
<script src="{{ asset('assets/acrtfm/js/modules/tech-dispatch/customers.js') }}"></script>