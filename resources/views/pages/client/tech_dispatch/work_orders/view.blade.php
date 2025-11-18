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
            
            @php
                $statementData = $statement ?? [];
                $statementExists = !empty($statementData);
                $workOrderStatus = strtolower($work_order['status'] ?? '');
                $completedStatuses = [
                    strtolower(config('acrtfm.work_order_statuses.completed')),
                    'completed',
                ];
                $canCreateStatement = (!$statementExists) && in_array($workOrderStatus, $completedStatuses, true);
                $header_tools = [
                    [
                        'type' => 'link',
                        'text' => 'Generate Quotation',
                        'icon' => 'fa fa-file-pdf',
                        'attrib' => [
                            'class' => 'btn btn-success btn-sm',
                            'title' => 'Generate PDF Quotation',
                            'href' => route('exec-work-orders-generate-quotation', $work_order['id']),
                            'target' => '_blank',
                        ],
                    ],
                    [
                        'type' => 'button',
                        'text' => 'Sign Quotation',
                        'icon' => 'fa fa-signature',
                        'attrib' => [
                            'class' => 'btn btn-info btn-sm',
                            'title' => 'Signature Options',
                            'data-toggle' => 'modal',
                            'data-target' => '#signatureOptionsModal',
                            'data-work-order-id' => $work_order['id'],
                        ],
                    ],
                ];
                if ($statementExists) {
                    $header_tools[] = [
                        'type' => 'link',
                        'text' => 'View Statement',
                        'icon' => 'fa fa-file-invoice-dollar',
                        'attrib' => [
                            'class' => 'btn btn-warning btn-sm text-white',
                            'title' => 'View Statement of Account',
                            'href' => route('work-orders.statement.show', $work_order['id']),
                        ],
                    ];
                } elseif ($canCreateStatement) {
                    $header_tools[] = [
                        'type' => 'link',
                        'text' => 'Create Statement',
                        'icon' => 'fa fa-file-invoice-dollar',
                        'attrib' => [
                            'class' => 'btn btn-warning btn-sm text-white',
                            'title' => 'Create Statement of Account',
                            'href' => route('work-orders.statement.show', $work_order['id']),
                        ],
                    ];
                }
            @endphp

            <x-card
                :title="$work_order['title']"
                :subtitle="$customer_name"
                :hr="true"
                :tools="$header_tools"
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

<div class="modal fade" id="signatureOptionsModal" tabindex="-1" role="dialog" aria-labelledby="signatureOptionsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="signatureOptionsModalLabel"><i class="fa fa-signature mr-2"></i>Quotation Signature Options</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="mb-4">
                    Choose how you would like this quotation to be signed. You can email a secure link to the customer for online signing or allow the customer to sign immediately on this device.
                </p>

                <div class="card border-0 mb-4 shadow-sm">
                    <div class="card-body">
                        <h6 class="text-primary font-weight-bold"><i class="fa fa-envelope mr-2"></i>Email Signature Link</h6>
                        <p class="text-muted mb-3">Send the customer a secure link to sign the quotation online.</p>
                        <div class="form-group mb-3">
                            <label for="signatureRecipientEmail" class="font-weight-semibold">Customer Email Address</label>
                            <input
                                type="email"
                                class="form-control"
                                id="signatureRecipientEmail"
                                placeholder="customer@example.com"
                                value="{{ $work_order['customer']['email'] ?? '' }}"
                            >
                            <small class="form-text text-muted">We'll send a time-limited secure link to this email.</small>
                        </div>
                        <button
                            type="button"
                            class="btn btn-primary btn-block"
                            id="sendSignatureEmailButton"
                            data-trigger="send-signature-email"
                            data-id="{{ $work_order['id'] }}"
                            data-default-text="Send Signature Link"
                        >
                            <i class="fa fa-paper-plane mr-1"></i> Send Signature Link
                        </button>
                    </div>
                </div>

                <div class="card border-0 shadow-sm">
                    <div class="card-body bg-light">
                        <h6 class="text-success font-weight-bold"><i class="fa fa-tablet-alt mr-2"></i>Sign On This Device</h6>
                        <p class="text-muted mb-3">Open the signature page now and have the customer sign immediately.</p>
                        <a
                            href="{{ route('quotation.sign', $work_order['id']) }}"
                            target="_blank"
                            class="btn btn-success btn-block"
                        >
                            <i class="fa fa-check-circle mr-1"></i> Open Signature Page
                        </a>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

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