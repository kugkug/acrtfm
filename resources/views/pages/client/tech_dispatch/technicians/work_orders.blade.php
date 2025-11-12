@include('partials.auth.header')


<section class="container-fluid">
    <div class="row">
        <div class="col-lg-12">

            <x-card > 
                <x-input :attrib="[
                    'name' => 'search',
                    'placeholder' => 'Search work orders...',
                    'dataKey' => 'search',
                    'class' => 'form-control form-control-sm override-input',
                ]" />

            </x-card>
            
            @if(count($work_orders) > 0)
                @foreach($work_orders as $work_order)
                    @php
                        $tools = [
                            [
                                'type' => 'link',
                                'text' => '',
                                'icon' => 'fa fa-eye',
                                'attrib' => [
                                    'class' => 'btn btn-default btn-sm text-info',
                                    'title' => 'View',
                                    'href' => route('work-orders.view', $work_order['id']),
                                ],
                            ],
                            [
                                'type' => 'link',
                                'text' => '',
                                'icon' => 'fa fa-edit',
                                'attrib' => [
                                    'class' => 'btn btn-default btn-sm text-warning',
                                    'title' => 'Edit',
                                    'href' => route('work-orders.edit', $work_order['id']),
                                ],
                            ],
                            [
                                'type' => 'button',
                                'text' => '',
                                'icon' => 'fa fa-trash',
                                'attrib' => [
                                    'class' => 'btn  btn-default btn-sm text-danger',
                                    'title' => 'Delete',
                                    'data-trigger' => 'delete-work-order',
                                    'data-id' => $work_order['id'],
                                ],
                            ],
                        ];
                        
                        $title = $work_order['title'];                        
                        // $customer_name = $work_order['customer']['first_name'] . ' ' . $work_order['customer']['last_name'];
                    @endphp

                    <x-card
                        :title="$title"
                        :subtitle="''"
                        :hr="true"
                        :tools="$tools"
                    >
                        <dl>
                            @if($work_order['description'])
                                <dd><i class="fa fa-sticky-note mr-2"></i> {{ $work_order['description'] }}</dd>
                            @endif

                            @if($work_order['priority'])
                                <dd><i class="fa fa-exclamation-triangle mr-2"></i> {{ $work_order['priority'] }}</dd>
                            @endif
                        
                            @if($work_order['schedule_date'])
                                <dd><i class="fa fa-calendar mr-2"></i> {{ $work_order['schedule_date'] }}</dd>
                            @endif
                        </dl>
                    </x-card>
                @endforeach
            @endif
            
        </div>
    </div>
</section>

@include('partials.auth.footer')

<script src="{{ asset('assets/acrtfm/js/modules/tech-dispatch/work-orders.js') }}"></script>