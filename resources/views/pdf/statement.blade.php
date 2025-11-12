<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Statement of Account</title>
    <style>
        body {
            font-family: "DejaVu Sans", Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333333;
        }
        .container {
            width: 90%;
            margin: 0 auto;
            padding: 30px 0;
        }
        h1, h2, h3, h4, h5, h6 {
            margin: 0;
            padding: 0;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        .header .title {
            font-size: 24px;
            font-weight: bold;
            color: #2c3e50;
        }
        .section {
            margin-bottom: 25px;
        }
        .section-title {
            font-size: 16px;
            font-weight: bold;
            color: #2c3e50;
            border-bottom: 1px solid #e0e0e0;
            padding-bottom: 5px;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table th, table td {
            border: 1px solid #e0e0e0;
            padding: 8px 10px;
        }
        table thead th {
            background-color: #f5f6fa;
            text-align: left;
        }
        table tbody tr:nth-child(even) {
            background-color: #fafafa;
        }
        .text-right {
            text-align: right;
        }
        .totals-table {
            width: 45%;
            margin-left: auto;
            border: none;
        }
        .totals-table td {
            border: none;
            padding: 4px 0;
        }
        .totals-table tr.total td {
            font-weight: bold;
            border-top: 1px solid #e0e0e0;
            padding-top: 8px;
        }
        .totals-table tr.balance td {
            font-size: 16px;
            font-weight: bold;
            color: #c0392b;
            padding-top: 8px;
        }
        .notes {
            background-color: #f8f9fc;
            border: 1px solid #e0e0e0;
            padding: 15px;
            border-radius: 6px;
            min-height: 60px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div>
                <div class="title">Statement of Account</div>
                <div>Statement #: {{ $statement->statement_number }}</div>
                <div>Date Issued: {{ \Carbon\Carbon::parse($statement->issued_at)->format('F d, Y') }}</div>
                @if($statement->due_at)
                    <div>Due Date: {{ \Carbon\Carbon::parse($statement->due_at)->format('F d, Y') }}</div>
                @endif
            </div>
            <div style="text-align: right;">
                <div><strong>Work Order:</strong> WO-{{ str_pad($work_order['id'], 6, '0', STR_PAD_LEFT) }}</div>
                <div><strong>Title:</strong> {{ $work_order['title'] ?? 'N/A' }}</div>
                <div><strong>Status:</strong> {{ ucfirst($work_order['status'] ?? 'N/A') }}</div>
            </div>
        </div>

        <div class="section">
            <div class="section-title">Bill To</div>
            <table>
                <tbody>
                    <tr>
                        <td width="50%">
                            <strong>{{ $work_order['customer']['first_name'] ?? '' }} {{ $work_order['customer']['last_name'] ?? '' }}</strong><br>
                            @if(!empty($work_order['customer']['email']))
                                Email: {{ $work_order['customer']['email'] }}<br>
                            @endif
                            @if(!empty($work_order['customer']['phone']))
                                Phone: {{ $work_order['customer']['phone'] }}<br>
                            @endif
                            @if(!empty($work_order['customer']['address']))
                                Address: {{ $work_order['customer']['address'] }}
                            @endif
                        </td>
                        <td width="50%">
                            <strong>Issued By</strong><br>
                            {{ optional($statement->creator)->name ?? 'System' }}<br>
                            {{ config('app.name') }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="section">
            <div class="section-title">Line Items</div>
            <table>
                <thead>
                    <tr>
                        <th>Description</th>
                        <th class="text-right" width="15%">Quantity</th>
                        <th class="text-right" width="15%">Unit Price</th>
                        <th class="text-right" width="15%">Line Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($statement->line_items ?? [] as $item)
                        <tr>
                            <td>{{ $item['description'] ?? '' }}</td>
                            <td class="text-right">{{ number_format($item['quantity'] ?? 0, 2) }}</td>
                            <td class="text-right">${{ number_format($item['unit_price'] ?? 0, 2) }}</td>
                            <td class="text-right">${{ number_format($item['line_total'] ?? 0, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="section">
            <table class="totals-table">
                <tr>
                    <td>Subtotal:</td>
                    <td class="text-right">${{ number_format($statement->subtotal_amount, 2) }}</td>
                </tr>
                <tr>
                    <td>Tax ({{ number_format($statement->tax_rate, 2) }}%):</td>
                    <td class="text-right">${{ number_format($statement->tax_amount, 2) }}</td>
                </tr>
                <tr>
                    <td>Discounts:</td>
                    <td class="text-right">-${{ number_format($statement->discount_amount, 2) }}</td>
                </tr>
                <tr class="total">
                    <td>Total Due:</td>
                    <td class="text-right">${{ number_format($statement->total_amount, 2) }}</td>
                </tr>
                <tr>
                    <td>Amount Paid:</td>
                    <td class="text-right">-${{ number_format($statement->amount_paid, 2) }}</td>
                </tr>
                <tr class="balance">
                    <td>Balance:</td>
                    <td class="text-right">${{ number_format($statement->balance_due, 2) }}</td>
                </tr>
            </table>
        </div>

        @if($statement->notes)
            <div class="section">
                <div class="section-title">Notes</div>
                <div class="notes">
                    {{ $statement->notes }}
                </div>
            </div>
        @endif
    </div>
</body>
</html>

