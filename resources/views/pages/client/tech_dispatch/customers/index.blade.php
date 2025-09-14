@include('partials.auth.header')


<section class="container-fluid">
    <div class="row">
        <div class="col-lg-12">

            <x-card > 
                {{-- The "column" attribute in a Blade component like <x-input> 
                    is typically used to specify the database column or data field that the input is associated with. 
                    For example:
                    <x-input :name="'search'" :label="'Search'" :placeholder="'Search customers...'" :dataKey="'search'" column="search" />
                    will bind the input value to the 'search' column in the database.
                --}}
                <x-input :name="'search'" :placeholder="'Search customers...'" :dataKey="'search'"  />
            </x-card>

            @if(count($customers) > 0)
                @foreach($customers as $customer)
                    @php
                        $tools = implode(',', [
                            '|view-customer|btn-default btn-sm|fa fa-eye',
                            '|edit-customer|btn-default btn-sm|fa fa-edit',
                            '|delete-customer|btn-default btn-sm|fa fa-trash text-danger',
                        ]);
                    @endphp

                    <x-card
                        title="{{ ucwords($customer['first_name']) }} {{ ucwords($customer['last_name']) }}"
                        subtitle="{{ $customer['company'] }}"
                        hr="yes"
                        tools="{{ $tools }}"
                    >
                        <p>{{ $customer['email'] }}</p>
                        <p>{{ $customer['phone'] }}</p>
                        <p>{{ $customer['address'] }}</p>
                        <p>{{ $customer['notes'] }}</p>
                    </x-card>
                @endforeach
            @endif
        </div>
    </div>
</section>

@include('partials.auth.footer')
