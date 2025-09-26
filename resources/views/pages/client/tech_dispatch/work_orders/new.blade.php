@include('partials.auth.header')

@php
    $footer = [
        [
            'type' => 'button',
            'text' => 'Create Work Order',
            'icon' => 'fa fa-save',
            'attrib' => [
                'class' => 'btn btn-success btn-flat',
                'title' => 'Create Work Order',
                'data-trigger' => 'create-work-order',
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

    $filtered_customers = [];
    foreach($customers as $customer) {
        $filtered_customers[] = [
            'id' => $customer['id'],
            'label' => $customer['company'],
        ];
    }

    $filtered_priority_levels = [];
    foreach(config('acrtfm.priority_levels') as $key => $value) {
        $filtered_priority_levels[] = [
            'id' => $key,
            'label' => $value,
        ];
    }
@endphp
<section class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <form>
                <x-card 
                    :title="'Work Order Information'" 
                    :subtitle="'Please provide work order information'"
                    id="work-order-information"
                    :footer="$footer"
                    hr="yes"
                >
                    <x-input 
                        :attrib="[
                            'name' => 'title',
                            'label' => 'Title',
                            'data-key' => 'Title',
                            'data' => 'req',
                            'class' => 'form-control form-control-sm override-input',
                        ]"
                    />
                    
                    <x-select 
                        :attrib="[
                            'id' => 'customer_id',
                            'name' => 'customer_id',
                            'label' => 'Customer',
                            'data-key' => 'CustomerId',
                            'data' => 'req',
                            'class' => 'form-control form-control-sm override-select',
                        ]"
                        :options="$filtered_customers"
                        :label="'Customer'"
                    />

                    <div class="row">
                        <div class="col-md-6">
                            <x-select 
                                :attrib="[
                                    'id' => 'priority',
                                    'name' => 'priority',
                                    'label' => 'Priority',
                                    'data-key' => 'Priority',
                                    'data' => '',
                                    'class' => 'form-control form-control-sm override-select',
                                ]"
                                :options="$filtered_priority_levels"
                                :label="'Priority'"
                            />
                        </div>
                        <div class="col-md-6">
                            <x-input 
                                :attrib="[
                                    'type' => 'number',
                                    'name' => 'estimated_hours',
                                    'label' => 'Estimated Hours',
                                    'data-key' => 'EstimatedHours',
                                    'data' => '',
                                    'class' => 'form-control form-control-sm override-input',
                                ]"
                            />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <x-input 
                                :attrib="[
                                    'type' => 'date',
                                    'name' => 'schedule_date',
                                    'label' => 'Schedule Date',
                                    'data-key' => 'ScheduleDate',
                                    'data' => '',
                                    'class' => 'form-control form-control-sm override-input',
                                ]"
                            />

                        </div>

                        <div class="col-md-6">
                            <x-input 
                                :attrib="[
                                    'type' => 'time',
                                    'name' => 'schedule_time',
                                    'label' => 'Schedule Time',
                                    'data-key' => 'ScheduleTime',
                                    'data' => '',
                                    'class' => 'form-control form-control-sm override-input',
                                ]"
                            />

                        </div>
                    </div>
                    
                    <x-textarea 
                        :attrib="[
                            'name' => 'description',
                            'label' => 'Description',
                            'data-key' => 'Description',
                            'data' => '',
                            'rows' => 4,
                            'class' => 'form-control form-control-sm override-textarea',
                        ]"
                    />

                </x-card>
            </form>
        </div>
    </div>
</section>

@include('partials.auth.footer')
<script src="{{ asset('assets/acrtfm/js/modules/tech-dispatch/work-orders.js') }}"></script>