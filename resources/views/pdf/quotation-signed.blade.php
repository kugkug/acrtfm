<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Signed Work Order Quote</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            line-height: 1.6;
            color: #333;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #28a745;
            padding-bottom: 20px;
        }
        
        .header h1 {
            margin: 0;
            color: #28a745;
            font-size: 28px;
        }
        
        .header .subtitle {
            color: #666;
            margin-top: 5px;
        }
        
        .signed-badge {
            background-color: #28a745;
            color: white;
            padding: 8px 15px;
            display: inline-block;
            margin-top: 10px;
            border-radius: 3px;
            font-weight: bold;
        }
        
        .section {
            margin-bottom: 25px;
        }
        
        .section-title {
            background-color: #28a745;
            color: white;
            padding: 10px;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        
        .info-table td {
            padding: 8px;
            border: 1px solid #ddd;
        }
        
        .info-table td.label {
            background-color: #f8f9fa;
            font-weight: bold;
            width: 30%;
        }
        
        .signature-box {
            border: 2px solid #28a745;
            padding: 15px;
            margin: 20px 0;
            background-color: #f8f9fa;
        }
        
        .signature-image {
            max-width: 300px;
            max-height: 100px;
            border: 1px solid #ddd;
            padding: 5px;
            background: white;
        }
        
        .signature-details {
            margin-top: 10px;
            font-size: 11px;
        }
        
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 10px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
        
        .notes-list {
            list-style: none;
            padding: 0;
        }
        
        .notes-list li {
            padding: 8px;
            margin-bottom: 5px;
            border-left: 3px solid #28a745;
            background-color: #f8f9fa;
        }
        
        .note-type {
            font-weight: bold;
            color: #28a745;
            font-size: 11px;
            text-transform: uppercase;
        }
        
        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 11px;
            font-weight: bold;
        }
        
        .badge-high {
            background-color: #dc3545;
            color: white;
        }
        
        .badge-medium {
            background-color: #ffc107;
            color: #333;
        }
        
        .badge-low {
            background-color: #28a745;
            color: white;
        }
        
        .company-info {
            text-align: center;
            margin-top: 10px;
            font-size: 11px;
            color: #666;
        }
        
        .verification-info {
            background-color: #e7f5e9;
            border: 1px solid #28a745;
            padding: 10px;
            margin-top: 10px;
            font-size: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>SIGNED WORK ORDER QUOTE</h1>
        <div class="subtitle">Quote No: WO-{{ str_pad($work_order['id'], 6, '0', STR_PAD_LEFT) }}</div>
        <div class="signed-badge">✓ ELECTRONICALLY SIGNED</div>
        <div class="company-info">
            Generated on: {{ formatNow('m/d/Y H:i') }}
        </div>
    </div>
    
    <!-- Signature Section (First) -->
    <div class="section">
        <div class="section-title">ELECTRONIC SIGNATURE</div>
        <div class="signature-box">
            <table style="width: 100%;">
                <tr>
                    <td style="width: 60%; vertical-align: top;">
                        <div class="signature-details">
                            <p style="margin: 5px 0;"><strong>Signed by:</strong> {{ $signature->signer_name }}</p>
                            @if($signature->signer_email)
                            <p style="margin: 5px 0;"><strong>Email:</strong> {{ $signature->signer_email }}</p>
                            @endif
                            <p style="margin: 5px 0;"><strong>Date & Time:</strong> {{ formatDateWithTimezone($signature->signed_at) }}</p>
                            <p style="margin: 5px 0;"><strong>IP Address:</strong> {{ $signature->ip_address }}</p>
                        </div>
                    </td>
                    <td style="width: 40%; text-align: right; vertical-align: top;">
                        <img src="{{ $signature->signature_data }}" alt="Signature" class="signature-image">
                    </td>
                </tr>
            </table>
        </div>
        <div class="verification-info">
            <strong>Verification:</strong> This document was electronically signed using a secure digital signature system. 
            The signature above is legally binding and was captured on {{ formatDateWithTimezone($signature->signed_at) }} 
            from IP address {{ $signature->ip_address }}.
        </div>
    </div>
    
    <!-- Customer Information -->
    <div class="section">
        <div class="section-title">CUSTOMER INFORMATION</div>
        <table class="info-table">
            <tr>
                <td class="label">Customer Name</td>
                <td>{{ $work_order['customer']['name'] ?: $work_order['customer']['company'] }}</td>
            </tr>
            @if(!empty($work_order['customer']['email']))
            <tr>
                <td class="label">Email</td>
                <td>{{ $work_order['customer']['email'] }}</td>
            </tr>
            @endif
            @if(!empty($work_order['customer']['phone']))
            <tr>
                <td class="label">Phone</td>
                <td>{{ $work_order['customer']['phone'] }}</td>
            </tr>
            @endif
            @if(!empty($work_order['customer']['address']))
            <tr>
                <td class="label">Address</td>
                <td>{{ $work_order['customer']['address'] }}</td>
            </tr>
            @endif
        </table>
    </div>
    
    <!-- Work Order Details -->
    <div class="section">
        <div class="section-title">WORK ORDER DETAILS</div>
        <table class="info-table">
            <tr>
                <td class="label">Work Order ID</td>
                <td>WO-{{ str_pad($work_order['id'], 6, '0', STR_PAD_LEFT) }}</td>
            </tr>
            <tr>
                <td class="label">Title</td>
                <td>{{ $work_order['title'] }}</td>
            </tr>
            @if(!empty($work_order['description']))
            <tr>
                <td class="label">Description</td>
                <td>{{ $work_order['description'] }}</td>
            </tr>
            @endif
            @if(!empty($work_order['priority']))
            <tr>
                <td class="label">Priority</td>
                <td>
                    @php
                        $priority = strtolower($work_order['priority']);
                        $badgeClass = 'badge-medium';
                        if ($priority == 'high' || $priority == 'urgent') {
                            $badgeClass = 'badge-high';
                        } elseif ($priority == 'low') {
                            $badgeClass = 'badge-low';
                        }
                    @endphp
                    <span class="badge {{ $badgeClass }}">{{ strtoupper($work_order['priority']) }}</span>
                </td>
            </tr>
            @endif
            @if(!empty($work_order['schedule_date']))
            <tr>
                <td class="label">Scheduled Date</td>
                <td>{{ $work_order['schedule_date'] }}</td>
            </tr>
            @endif
            @if(!empty($work_order['schedule_time']))
            <tr>
                <td class="label">Scheduled Time</td>
                <td>{{ $work_order['schedule_time'] }}</td>
            </tr>
            @endif
            @if(!empty($work_order['status']))
            <tr>
                <td class="label">Status</td>
                <td>{{ ucfirst($work_order['status']) }}</td>
            </tr>
            @endif
        </table>
    </div>
    
    <!-- Notes Section -->
    @if(!empty($work_order['notes']) && count($work_order['notes']) > 0)
    <div class="section">
        <div class="section-title">NOTES & OBSERVATIONS</div>
        <ul class="notes-list">
            @foreach($work_order['notes'] as $note)
            <li>
                @if(!empty($note['note_type']))
                <span class="note-type">{{ $note['note_type'] }}</span><br/>
                @endif
                {{ $note['note'] }}
                @if(!empty($note['created_at']))
                <br/><small style="color: #999;">Added: {{ formatDateWithTimezone($note['created_at']) }}</small>
                @endif
            </li>
            @endforeach
        </ul>
    </div>
    @endif
    
    <!-- Photos Section -->
    @if(!empty($work_order['photos']) && count($work_order['photos']) > 0)
    <div class="section">
        <div class="section-title">ATTACHED PHOTOS</div>
        <table class="info-table">
            <tr>
                <td class="label">Total Photos</td>
                <td>{{ count($work_order['photos']) }} photo(s) attached to this work order</td>
            </tr>
            <tr>
                <td class="label">Photo List</td>
                <td>
                    @foreach($work_order['photos'] as $index => $photo)
                        {{ $index + 1 }}. {{ $photo['name'] ?? 'Photo ' . ($index + 1) }}
                        @if($index < count($work_order['photos']) - 1)<br/>@endif
                    @endforeach
                </td>
            </tr>
        </table>
    </div>
    @endif
    
    <div class="footer">
        <p>This is an electronically signed document. The signature has been verified and recorded.</p>
        <p>&copy; {{ date('Y') }} - All Rights Reserved</p>
    </div>
</body>
</html>

