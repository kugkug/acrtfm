@include('partials.auth.header')

<section class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <x-card
                :title="$work_order['title'] ?? 'Work Order'"
                :subtitle="'WO-' . str_pad($work_order['id'], 6, '0', STR_PAD_LEFT)"
                :hr="true"
            >
                <div class="mb-3">
                    <a href="{{ route('work-orders.view', $work_order['id']) }}" class="btn btn-light btn-sm">
                        <i class="fa fa-arrow-left"></i> Back to Work Order
                    </a>
                </div>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                @if(isset($statement) && $statement)
                    <div class="statement-header mb-4">
                        <h4 class="mb-1 text-primary">
                            <i class="fa fa-file-invoice-dollar mr-2"></i> Statement of Account
                        </h4>
                        <p class="text-muted mb-0">
                            Issued on {{ formatDateWithTimezone($statement->issued_at, 'F d, Y') }}
                            @if($statement->due_at)
                                &middot; Due {{ formatDateWithTimezone($statement->due_at, 'F d, Y') }}
                            @endif
                        </p>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card shadow-sm border-0 mb-4">
                                <div class="card-body">
                                    <h5 class="card-title text-secondary">Customer Information</h5>
                                    <p class="mb-1"><strong>Customer:</strong> {{ $work_order['customer']['name'] ?: $work_order['customer']['company'] }}</p>
                                    @if(!empty($work_order['customer']['email']))
                                        <p class="mb-1"><strong>Email:</strong> {{ $work_order['customer']['email'] }}</p>
                                    @endif
                                    @if(!empty($work_order['customer']['phone']))
                                        <p class="mb-0"><strong>Phone:</strong> {{ $work_order['customer']['phone'] }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card shadow-sm border-0 mb-4">
                                <div class="card-body">
                                    <h5 class="card-title text-secondary">Statement Details</h5>
                                    <p class="mb-1"><strong>Statement #:</strong> {{ $statement->statement_number }}</p>
                                    <p class="mb-1"><strong>Status:</strong>
                                        @if($statement->balance_due > 0)
                                            <span class="badge badge-warning">Balance Due</span>
                                        @else
                                            <span class="badge badge-success">Paid</span>
                                        @endif
                                    </p>
                                    <p class="mb-0"><strong>Prepared by:</strong> {{ optional($statement->creator)->name ?? 'System' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th>Description</th>
                                    <th class="text-right">Quantity</th>
                                    <th class="text-right">Unit Price</th>
                                    <th class="text-right">Line Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($statement->line_items ?? [] as $item)
                                    <tr>
                                        <td>{{ $item['description'] ?? '' }}</td>
                                        <td class="text-right">{{ number_format($item['quantity'] ?? 0, 2) }}</td>
                                        <td class="text-right">${{ number_format($item['unit_price'] ?? 0, 2) }}</td>
                                        <td class="text-right font-weight-bold">${{ number_format($item['line_total'] ?? 0, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            @if($statement->notes)
                                <div class="card border-0 shadow-sm mb-4">
                                    <div class="card-body">
                                        <h5 class="card-title text-secondary">Additional Notes</h5>
                                        <p class="mb-0">{{ $statement->notes }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm mb-4">
                                <div class="card-body">
                                    <h5 class="card-title text-secondary">Financial Summary</h5>
                                    <table class="table table-borderless mb-0">
                                        <tr>
                                            <td>Subtotal</td>
                                            <td class="text-right">${{ number_format($statement->subtotal_amount, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Tax ({{ number_format($statement->tax_rate, 2) }}%)</td>
                                            <td class="text-right">${{ number_format($statement->tax_amount, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Discounts</td>
                                            <td class="text-right text-success">-${{ number_format($statement->discount_amount, 2) }}</td>
                                        </tr>
                                        <tr class="font-weight-bold">
                                            <td>Total Due</td>
                                            <td class="text-right">${{ number_format($statement->total_amount, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Amount Paid</td>
                                            <td class="text-right text-success">-${{ number_format($statement->amount_paid, 2) }}</td>
                                        </tr>
                                        <tr class="font-weight-bold">
                                            <td>Balance</td>
                                            <td class="text-right text-{{ $statement->balance_due > 0 ? 'danger' : 'success' }}">
                                                ${{ number_format($statement->balance_due, 2) }}
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('work-orders.statement.download', $work_order['id']) }}" class="btn btn-primary">
                            <i class="fa fa-download"></i> Download PDF
                        </a>
                        <a href="{{ route('work-orders.view', $work_order['id']) }}" class="btn btn-secondary">
                            Return to Work Order
                        </a>
                    </div>
                @else
                    <h4 class="mb-4 text-primary">
                        <i class="fa fa-file-invoice-dollar mr-2"></i> Create Statement of Account
                    </h4>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <strong>There were some issues with your submission:</strong>
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('work-orders.statement.store', $work_order['id']) }}" id="statementForm">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="statementDate" class="font-weight-semibold">Statement Date <span class="text-danger">*</span></label>
                                    <input type="date" id="statementDate" name="statement_date" class="form-control"
                                           value="{{ old('statement_date', now()->format('Y-m-d')) }}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="dueDate" class="font-weight-semibold">Due Date</label>
                                    <input type="date" id="dueDate" name="due_date" class="form-control"
                                           value="{{ old('due_date') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="font-weight-semibold">Prepared By</label>
                                    <input type="text" class="form-control" value="{{ auth()->user()->name }}" disabled>
                                </div>
                            </div>
                        </div>

                        @php
                            $oldLineItems = old('line_items', [
                                ['description' => '', 'quantity' => 1, 'unit_price' => '']
                            ]);
                        @endphp

                        <div class="table-responsive">
                            <table class="table table-bordered" id="lineItemsTable">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Description <span class="text-danger">*</span></th>
                                        <th class="text-right">Quantity</th>
                                        <th class="text-right">Unit Price</th>
                                        <th class="text-right">Line Total</th>
                                        <th style="width: 50px;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($oldLineItems as $index => $item)
                                        <tr class="line-item-row">
                                            <td>
                                                <input type="text"
                                                       class="form-control line-item-description"
                                                       name="line_items[{{ $index }}][description]"
                                                       placeholder="Describe work performed or materials used"
                                                       value="{{ old('line_items.' . $index . '.description', $item['description'] ?? '') }}"
                                                       required>
                                            </td>
                                            <td>
                                                <input type="number"
                                                       class="form-control text-right line-item-quantity"
                                                       name="line_items[{{ $index }}][quantity]"
                                                       min="0"
                                                       step="0.01"
                                                       value="{{ old('line_items.' . $index . '.quantity', $item['quantity'] ?? 1) }}">
                                            </td>
                                            <td>
                                                <input type="number"
                                                       class="form-control text-right line-item-unit-price"
                                                       name="line_items[{{ $index }}][unit_price]"
                                                       min="0"
                                                       step="0.01"
                                                       value="{{ old('line_items.' . $index . '.unit_price', $item['unit_price'] ?? '') }}">
                                            </td>
                                            <td class="text-right align-middle line-item-total">$0.00</td>
                                            <td class="text-center align-middle">
                                                <button type="button" class="btn btn-sm btn-outline-danger remove-line-item" title="Remove item">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mb-3">
                            <button type="button" class="btn btn-outline-primary" id="addLineItem">
                                <i class="fa fa-plus"></i> Add Line Item
                            </button>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="additionalNotes" class="font-weight-semibold">Additional Notes</label>
                                    <textarea
                                        id="additionalNotes"
                                        name="additional_notes"
                                        rows="4"
                                        class="form-control"
                                        placeholder="Add payment instructions or other important information"
                                    >{{ old('additional_notes') }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body">
                                        <h5 class="card-title text-secondary">Totals & Payments</h5>
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="taxRate" class="font-weight-semibold">Tax (%)</label>
                                                <input type="number" id="taxRate" name="tax_rate" min="0" step="0.01"
                                                       class="form-control text-right"
                                                       value="{{ old('tax_rate', 0) }}">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="discountAmount" class="font-weight-semibold">Discount</label>
                                                <input type="number" id="discountAmount" name="discount_amount" min="0" step="0.01"
                                                       class="form-control text-right"
                                                       value="{{ old('discount_amount', 0) }}">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="amountPaid" class="font-weight-semibold">Amount Paid</label>
                                                <input type="number" id="amountPaid" name="amount_paid" min="0" step="0.01"
                                                       class="form-control text-right"
                                                       value="{{ old('amount_paid', 0) }}">
                                            </div>
                                        </div>

                                        <hr>
                                        <div class="totals-summary">
                                            <div class="d-flex justify-content-between">
                                                <span>Subtotal</span>
                                                <strong id="summarySubtotal">$0.00</strong>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <span>Tax</span>
                                                <strong id="summaryTax">$0.00</strong>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <span>Discount</span>
                                                <strong id="summaryDiscount">$0.00</strong>
                                            </div>
                                            <div class="d-flex justify-content-between font-weight-bold mt-2">
                                                <span>Total Due</span>
                                                <strong id="summaryTotal">$0.00</strong>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <span>Amount Paid</span>
                                                <strong id="summaryPaid">$0.00</strong>
                                            </div>
                                            <div class="d-flex justify-content-between font-weight-bold text-primary">
                                                <span>Balance</span>
                                                <strong id="summaryBalance">$0.00</strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 d-flex justify-content-between">
                            <a href="{{ route('work-orders.view', $work_order['id']) }}" class="btn btn-light">
                                Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save"></i> Save Statement
                            </button>
                        </div>
                    </form>
                @endif
            </x-card>
        </div>
    </div>
</section>

@include('partials.auth.footer')

@if(!isset($statement) || ! $statement)
    <script>
        (function () {
            const lineItemsTableBody = document.querySelector('#lineItemsTable tbody');
            const addLineItemButton = document.getElementById('addLineItem');

            function formatCurrency(amount) {
                return '$' + (amount || 0).toFixed(2);
            }

            function recalculateTotals() {
                let subtotal = 0;

                document.querySelectorAll('.line-item-row').forEach((row) => {
                    const quantityInput = row.querySelector('.line-item-quantity');
                    const unitPriceInput = row.querySelector('.line-item-unit-price');
                    const lineTotalCell = row.querySelector('.line-item-total');

                    const quantity = parseFloat(quantityInput.value) || 0;
                    const unitPrice = parseFloat(unitPriceInput.value) || 0;
                    const lineTotal = quantity * unitPrice;

                    subtotal += lineTotal;
                    lineTotalCell.textContent = formatCurrency(lineTotal);
                });

                const taxRate = parseFloat(document.getElementById('taxRate').value) || 0;
                let taxAmount = subtotal * (taxRate / 100);
                taxAmount = Math.max(taxAmount, 0);

                let discountAmount = parseFloat(document.getElementById('discountAmount').value) || 0;
                discountAmount = Math.min(Math.max(discountAmount, 0), subtotal + taxAmount);

                let total = subtotal + taxAmount - discountAmount;
                total = Math.max(total, 0);

                let amountPaid = parseFloat(document.getElementById('amountPaid').value) || 0;
                amountPaid = Math.min(Math.max(amountPaid, 0), total);

                const balance = Math.max(total - amountPaid, 0);

                document.getElementById('summarySubtotal').textContent = formatCurrency(subtotal);
                document.getElementById('summaryTax').textContent = formatCurrency(taxAmount);
                document.getElementById('summaryDiscount').textContent = formatCurrency(discountAmount);
                document.getElementById('summaryTotal').textContent = formatCurrency(total);
                document.getElementById('summaryPaid').textContent = formatCurrency(amountPaid);
                document.getElementById('summaryBalance').textContent = formatCurrency(balance);
            }

            function reindexLineItems() {
                const rows = lineItemsTableBody.querySelectorAll('.line-item-row');
                rows.forEach((row, index) => {
                    row.querySelector('.line-item-description')
                        .setAttribute('name', `line_items[${index}][description]`);
                    row.querySelector('.line-item-quantity')
                        .setAttribute('name', `line_items[${index}][quantity]`);
                    row.querySelector('.line-item-unit-price')
                        .setAttribute('name', `line_items[${index}][unit_price]`);
                });
            }

            function addLineItemRow(defaults = {}) {
                const row = document.createElement('tr');
                row.classList.add('line-item-row');

                row.innerHTML = `
                    <td>
                        <input type="text"
                               class="form-control line-item-description"
                               placeholder="Describe work performed or materials used"
                               value="${defaults.description || ''}"
                               required>
                    </td>
                    <td>
                        <input type="number"
                               class="form-control text-right line-item-quantity"
                               min="0"
                               step="0.01"
                               value="${defaults.quantity !== undefined ? defaults.quantity : 1}">
                    </td>
                    <td>
                        <input type="number"
                               class="form-control text-right line-item-unit-price"
                               min="0"
                               step="0.01"
                               value="${defaults.unit_price !== undefined ? defaults.unit_price : ''}">
                    </td>
                    <td class="text-right align-middle line-item-total">$0.00</td>
                    <td class="text-center align-middle">
                        <button type="button" class="btn btn-sm btn-outline-danger remove-line-item" title="Remove item">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                `;

                lineItemsTableBody.appendChild(row);
                reindexLineItems();
                recalculateTotals();
            }

            if (lineItemsTableBody.querySelectorAll('.line-item-row').length === 0) {
                addLineItemRow();
            }

            addLineItemButton.addEventListener('click', () => {
                addLineItemRow();
            });

            lineItemsTableBody.addEventListener('click', (event) => {
                if (event.target.closest('.remove-line-item')) {
                    const rows = lineItemsTableBody.querySelectorAll('.line-item-row');
                    if (rows.length <= 1) {
                        return;
                    }
                    event.target.closest('tr').remove();
                    reindexLineItems();
                    recalculateTotals();
                }
            });

            document.addEventListener('input', (event) => {
                if (event.target.matches('.line-item-quantity, .line-item-unit-price, #taxRate, #discountAmount, #amountPaid')) {
                    recalculateTotals();
                }
            });

            recalculateTotals();
        })();
    </script>
@endif

