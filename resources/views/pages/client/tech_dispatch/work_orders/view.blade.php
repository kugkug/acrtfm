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
                        'text' => (isset($work_order['photos']) ? count($work_order['photos']) : 0) . '<br />Photos',
                        'class' => 'btn-outline-primary py-4',
                        'data-target' => 'card-photos',
                        'data-id' => $work_order['id'],
                        'card-details' => [
                            'title' => 'Photos',
                            'subtitle' => 'Upload and manage photos for this work order',
                            'hr' => true,
                            'tools' => [
                                [
                                    'type' => 'button',
                                    'text' => 'Add Photos',
                                    'icon' => 'fa fa-plus',
                                    'attrib' => [
                                        'data-trigger' => 'add-photos',
                                        'data-id' => $work_order['id'],
                                        'class' => 'btn btn-primary btn-flat',
                                    ],
                                ],
                            ],
                        ],
                    ],
                    [
                        'type' => 'button',
                        'icon' => '',
                        'text' => (isset($work_order['notes']) ? count($work_order['notes']) : 0) . '<br />Notes',
                        'class' => 'btn-outline-secondary py-4',
                        'data-target' => 'card-notes',
                        'data-id' => $work_order['id'],
                        'card-details' => [
                            'title' => 'Notes',
                            'subtitle' => 'Add and manage notes for this work order',
                            'hr' => true,
                        ],
                    ],
                    // [
                    //     'type' => 'button',
                    //     'icon' => '',
                    //     'text' => 'Equipment',
                    //     'class' => 'btn-outline-success py-4',
                    //     'data-target' => 'card-equipment',
                    //     'card-details' => [
                    //         'title' => 'Equipment',
                    //         'subtitle' => 'Add and manage equipment for this work order',
                    //         'hr' => true,
                    //     ],
                    // ],
                    [
                        'type' => 'button',
                        'icon' => '',
                        'text' => (isset($work_order['open_todos']) ? count($work_order['open_todos']) : 0) . '<br />Open Todos',
                        'class' => 'btn-outline-danger py-4',
                        'data-target' => 'card-open-todos',
                        'data-id' => $work_order['id'],
                        'card-details' => [
                            'title' => 'Open Todos',
                            'subtitle' => 'Add and manage open todos for this work order',
                            'hr' => true,

                        ],
                    ],
                    // [
                    //     'type' => 'button',
                    //     'icon' => '',
                    //     'text' => 'Checklists',
                    //     'class' => 'btn-outline-warning py-4',
                    //     'data-target' => 'card-checklists',
                    //     'card-details' => [
                    //         'title' => 'Checklists',
                    //         'subtitle' => 'Add and manage checklists for this work order',
                    //         'hr' => true,
                    //     ],
                    // ],
                    [
                        'type' => 'button',
                        'icon' => '',
                        'text' => (isset($work_order['quotes']) ? count($work_order['quotes']) : 0) . '<br />Quotes',
                        'class' => 'btn-outline-info py-4',
                        'data-target' => 'card-quotes',
                        'data-id' => $work_order['id'],
                        'card-details' => [
                            'title' => 'Quotes',
                            'subtitle' => 'Add and manage quotes for this work order',
                            'hr' => true,
                            'tools' => [
                                [
                                    'type' => 'link',
                                    'text' => 'Add Quotes',
                                    'icon' => 'fa fa-plus',
                                    'attrib' => [
                                        // 'href' => route('quotes.create', $work_order['id']),
                                        'class' => 'btn btn-info btn-flat text-white',
                                    ],
                                ],
                            ],
                        ],
                    ],
                    // [
                    //     'type' => 'button',
                    //     'icon' => '',
                    //     'text' => 'Invoices',
                    //     'class' => 'btn-outline-light py-4',
                    //     'data-target' => 'card-invoices',
                    //     'card-details' => [
                    //         'title' => 'Invoices',
                    //         'subtitle' => 'Add and manage invoices for this work order',
                    //         'hr' => true,
                    //     ],
                    // ],
                    // [
                    //     'type' => 'button',
                    //     'icon' => '',
                    //     'text' => 'History',
                    //     'class' => 'btn-outline-dark py-4',
                    //     'data-target' => 'card-history',
                    //     'card-details' => [
                    //         'title' => 'History',
                    //         'subtitle' => 'View the history of this work order',
                    //         'hr' => true,
                    //     ],
                    // ],
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
                                'data-id' => $button['data-id'],
                            ];

                            $text = $button['text'];

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
        @php
            $tools = $button['card-details']['tools'] ?? [];
        @endphp
        <div class="row d-none div-target" id="{{ $button['data-target'] }}">
            <div class="col-md-12">
                <x-card
                    :title="$button['card-details']['title']"
                    :subtitle="$button['card-details']['subtitle']"
                    :hr="true"
                    :tools="$tools"                  
                >

                    @if ($button['data-target'] == 'card-photos')
                        <x-input :attrib="[
                            'type' => 'file',
                            'class' => 'form-control',
                            'multiple' => 'multiple',
                            'style' => 'display: none;',
                            'data-key' => 'WorkOrderPhotos',
                        ]" />
                        <div class="image-list"></div>
                    
                    @elseif ($button['data-target'] == 'card-notes')

                        @php
                            $note_types = array_map(function($item) {
                                return [
                                    'id' => $item['id'],
                                    'label' => $item['label'],
                                ];
                            }, config('acrtfm.note_types'));

                        @endphp
                        
                        <form>
                            <div class="row">
                                <div class="col-md-8">
                                    <x-textarea :attrib="[
                                        'class' => 'form-control form-control-sm override-textarea',
                                        'data-key' => 'WorkOrderNote',
                                        'rows' => 2,
                                        'placeholder' => 'Add a note',
                                    ]" />
                                </div>
                                <div class="col-md-4">
                                    <x-select
                                    
                                    :label="''"
                                    :attrib="[
                                        'class' => 'form-control form-control-sm override-select',
                                        'data-key' => 'WorkOrderNoteType',
                                        'data' => false,
                                        'name' => 'WorkOrderNoteType',
                                    ]" 
                                    :label="''"
                                    :options="$note_types" />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <x-button 
                                        :attrib="[
                                            'data-trigger' => 'add-note',
                                            'data-id' => $work_order['id'],
                                            'class' => 'btn btn-primary btn-block btn-flat mb-5',
                                        ]"
                                        :icon="'fa fa-plus'"
                                        :text="'Add Note'"
                                        :type="'button'"
                                    />
                                </div>
                            </div>
                            
                        </form>
                        
                        <div class="note-list"></div>

                    @endif

                </x-card>
            </div>
        </div>
    @endforeach
</section>
<div class="modal fade modal-fullscreen" id="modal-image-view" tabindex="-1" role="dialog" aria-labelledby="modal-image-view-label" aria-hidden="true">
    
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        
        {{-- <div class="modal-header">
            <button class="btn btn-default btn-flat" data-trigger="close-image" data>
                <i class="fa fa-times"></i>
            </button>
        </div> --}}

        
        
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="close  text-info" data-dismiss="modal"><span>×</span></button>
            </div>
            <div class="modal-body">
                <div class="img-container"></div>
                <div class="d-flex justify-content-between">
                    
                    <button 
                        class="mt-3 btn btn-danger btn-block btn-flat" 
                        data-trigger="delete-image"
                        data-id=""
                        data-url=""
                    >
                        <i class="fa fa-trash"></i> Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@include('partials.auth.footer')

<script src="{{ asset('assets/acrtfm/js/modules/tech-dispatch/work-orders.js') }}"></script>