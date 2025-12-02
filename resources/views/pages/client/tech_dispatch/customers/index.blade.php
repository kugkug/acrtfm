@include('partials.auth.header')


<section class="container-fluid">
    <div class="row">
        <div class="col-lg-12">

            <x-card > 
                <x-input :attrib="[
                    'name' => 'search',
                    'placeholder' => 'Search customers...',
                    'dataKey' => 'search',
                    'class' => 'form-control form-control-sm override-input',
                ]" />

            </x-card>

            @if(count($customers) > 0)
                @foreach($customers as $customer)
                    @php
                    
                        $tools = [
                            [
                                'type' => 'link',
                                'text' => '',
                                'icon' => 'fa fa-eye',
                                'attrib' => [
                                    'class' => 'btn btn-default btn-sm text-info',
                                    'title' => 'View',
                                    'href' => route('customers.view', $customer['id']),
                                ],
                            ],
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
                                    'class' => 'btn btn-default btn-sm text-danger',
                                    'title' => 'Delete',
                                    'data-trigger' => 'delete-customer',
                                    'data-id' => $customer['id'],
                                ],
                            ],
                        ];
                        
                        $name = $customer['name'] ?? $customer['company'] ?? '-';
                        $company = $customer['company'] ?? '';

                    @endphp

                    <x-card
                        :title="$name"
                        :subtitle="$company"
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
                @endforeach
            @endif
        </div>
    </div>
</section>

@include('partials.auth.footer')

<script src="{{ asset('assets/acrtfm/js/modules/tech-dispatch/customers.js') }}"></script>