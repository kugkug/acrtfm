@include('partials.auth.header')

<section class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            @php
                $customer_name = $work_order['customer']['first_name'] . ' ' . $work_order['customer']['last_name'];
            
                $attrib = [
                    'class' => 'btn btn-sm text-info',
                    'title' => 'Photos',
                ];

                $buttons = [
                    [
                        'type' => 'button',
                        'icon' => '',
                        'text' => 'Photos',
                        'class' => 'btn-outline-primary py-4',
                        'data-target' => 'card-photos',
                        'card-details' => [
                            'title' => 'Photos',
                            'subtitle' => 'Upload and manage photos for this work order',
                            'hr' => true,
                        ],
                    ],
                    [
                        'type' => 'button',
                        'icon' => '',
                        'text' => 'Notes',
                        'class' => 'btn-outline-secondary py-4',
                        'data-target' => 'card-notes',
                        'card-details' => [
                            'title' => 'Notes',
                            'subtitle' => 'Add and manage notes for this work order',
                            'hr' => true,
                        ],
                    ],
                    [
                        'type' => 'button',
                        'icon' => '',
                        'text' => 'Equipment',
                        'class' => 'btn-outline-success py-4',
                        'data-target' => 'card-equipment',
                        'card-details' => [
                            'title' => 'Equipment',
                            'subtitle' => 'Add and manage equipment for this work order',
                            'hr' => true,
                        ],
                    ],
                    [
                        'type' => 'button',
                        'icon' => '',
                        'text' => 'Open Todos',
                        'class' => 'btn-outline-danger py-4',
                        'data-target' => 'card-open-todos',
                        'card-details' => [
                            'title' => 'Open Todos',
                            'subtitle' => 'Add and manage open todos for this work order',
                            'hr' => true,
                        ],
                    ],
                    [
                        'type' => 'button',
                        'icon' => '',
                        'text' => 'Checklists',
                        'class' => 'btn-outline-warning py-4',
                        'data-target' => 'card-checklists',
                        'card-details' => [
                            'title' => 'Checklists',
                            'subtitle' => 'Add and manage checklists for this work order',
                            'hr' => true,
                        ],
                    ],
                    [
                        'type' => 'button',
                        'icon' => '',
                        'text' => 'Quotes',
                        'class' => 'btn-outline-info py-4',
                        'data-target' => 'card-quotes',
                        'card-details' => [
                            'title' => 'Quotes',
                            'subtitle' => 'Add and manage quotes for this work order',
                            'hr' => true,
                        ],
                    ],
                    [
                        'type' => 'button',
                        'icon' => '',
                        'text' => 'Invoices',
                        'class' => 'btn-outline-light py-4',
                        'data-target' => 'card-invoices',
                        'card-details' => [
                            'title' => 'Invoices',
                            'subtitle' => 'Add and manage invoices for this work order',
                            'hr' => true,
                        ],
                    ],
                    [
                        'type' => 'button',
                        'icon' => '',
                        'text' => 'History',
                        'class' => 'btn-outline-dark py-4',
                        'data-target' => 'card-history',
                        'card-details' => [
                            'title' => 'History',
                            'subtitle' => 'View the history of this work order',
                            'hr' => true,
                        ],
                    ],
                ]
            @endphp
            
            <x-card
                :title="$work_order['title']"
                :subtitle="$customer_name"
                :hr="true"
            >
                <dl>
                    <dd class="bg-light p-2">{{ $work_order['description'] }}</dd>
                    <dd><i class="fa fa-calendar mr-2"></i> {{ $work_order['schedule_date'] }}</dd>
                    <dd><i class="fa fa-clock mr-2"></i> {{ $work_order['schedule_time'] }}</dd>
                </dl>
            </x-card>
           
            <x-card
                :title="'Quick Stats'"
                :subtitle="'Tap to navigate to different sections'"
                :hr="true"
            >
                <div class="row">

                    @foreach($buttons as $button)

                        @php
                            $attrib = [
                                'class' => 'btn btn-block ' . $button['class'],
                                'data-target' => $button['data-target'],
                            ];

                            $text = 1 . "<br />". $button['text'];

                        @endphp

                        <div class="col-xs-3 col-sm-3 mb-3">
                            <x-button 
                                :type="$button['type']"
                                :icon="$button['icon']"
                                :text="$text"
                                :attrib="$attrib"
                            />
                        </div>
                    @endforeach

                </div>
            </x-card>
        </div>
    </div>

    @foreach ($buttons as $button)
        <div class="row d-none div-target" id="{{ $button['data-target'] }}">
            <div class="col-md-12">                    
                <x-card
                    :title="$button['card-details']['title']"
                    :subtitle="$button['card-details']['subtitle']"
                    :hr="true"
                >
                    {!! $button['data-target'] !!}
                </x-card>
            </div>
        </div>
    @endforeach
</section>

@include('partials.auth.footer')

<script src="{{ asset('assets/acrtfm/js/modules/tech-dispatch/work-orders.js') }}"></script>