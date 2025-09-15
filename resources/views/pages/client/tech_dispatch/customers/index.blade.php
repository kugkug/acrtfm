@include('partials.auth.header')


<section class="container-fluid">
    <div class="row">
        <div class="col-lg-12">

            <x-card > 
                <x-input 
                    :name="'search'" 
                    :placeholder="'Search customers...'" 
                    :dataKey="'search'" 
                />

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
                                'type' => 'button',
                                'text' => '',
                                'icon' => 'fa fa-edit',
                                'attrib' => [
                                    'class' => 'btn btn-default btn-sm text-warning',
                                    'title' => 'Edit',
                                ],
                            ],
                            [
                                'type' => 'button',
                                'text' => '',
                                'icon' => 'fa fa-trash',
                                'attrib' => [
                                    'class' => 'btn  btn-default btn-sm text-danger',
                                    'title' => 'Delete',
                                ],
                            ],
                        ];
                        
                        $name = $customer['first_name'] . ' ' . $customer['last_name'];
                        $company = $customer['company'];
                    @endphp

                    <x-card
                        :title="$name"
                        :subtitle="$company"
                        :hr="true"
                        :tools="$tools"
                    >
                        <dl>
                            @if($customer['email'])
                                <dt><i class="fa fa-envelope mr-2"></i> {{ $customer['email'] }}</dt>
                            @endif

                            @if($customer['phone'])
                                <dt><i class="fa fa-phone mr-2"></i> {{ $customer['phone'] }}</dt>
                            @endif
                        
                            @if($customer['address'])
                                <dt><i class="fa fa-building mr-2"></i> {{ $customer['address'] }}</dt>
                            @endif

                            @if($customer['notes'])
                                <dt><i class="fa fa-sticky-note mr-2"></i> {{ $customer['notes'] }}</dt>
                            @endif
                        </dl>
                    </x-card>
                @endforeach
            @endif
        </div>
    </div>
</section>

@include('partials.auth.footer')
