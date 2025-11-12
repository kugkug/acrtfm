@include('partials.single-page.header')

<style>
    body {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        padding: 20px 0;
    }
    
    .quotation-container {
        max-width: 900px;
        margin: 0 auto;
        background: white;
        border-radius: 15px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        overflow: hidden;
    }
    
    .quotation-header {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
        padding: 30px;
        text-align: center;
    }
    
    .quotation-header i {
        font-size: 64px;
        margin-bottom: 15px;
    }
    
    .quotation-header h1 {
        margin: 0;
        font-size: 32px;
        font-weight: 700;
    }
    
    .quotation-header .subtitle {
        margin-top: 10px;
        font-size: 18px;
        opacity: 0.9;
    }
    
    .quotation-body {
        padding: 40px;
    }
    
    .success-message {
        text-align: center;
        padding: 30px;
        background-color: #d4edda;
        border-radius: 10px;
        margin-bottom: 30px;
        border: 2px solid #c3e6cb;
    }
    
    .success-message h2 {
        color: #155724;
        margin: 0 0 10px 0;
    }
    
    .success-message p {
        color: #155724;
        margin: 5px 0;
    }
    
    .section {
        margin-bottom: 30px;
    }
    
    .section-title {
        background-color: #f8f9fa;
        border-left: 4px solid #28a745;
        padding: 12px 15px;
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 15px;
        color: #333;
    }
    
    .info-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 15px;
    }
    
    .info-table td {
        padding: 12px;
        border-bottom: 1px solid #e9ecef;
    }
    
    .info-table td.label {
        background-color: #f8f9fa;
        font-weight: 600;
        width: 35%;
        color: #495057;
    }
    
    .signature-display {
        background: white;
        border: 2px solid #28a745;
        border-radius: 8px;
        padding: 20px;
        text-align: center;
    }
    
    .signature-display img {
        max-width: 100%;
        height: auto;
        border: 1px solid #dee2e6;
        padding: 10px;
        background: white;
    }
    
    .signature-info {
        margin-top: 15px;
        padding-top: 15px;
        border-top: 1px solid #dee2e6;
        text-align: left;
    }
    
    .signature-info p {
        margin: 5px 0;
        color: #495057;
    }
    
    .signature-info strong {
        color: #333;
    }
    
    .action-buttons {
        display: flex;
        gap: 15px;
        margin-top: 30px;
    }
    
    .btn {
        flex: 1;
        padding: 15px 24px;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-block;
        text-align: center;
    }
    
    .btn-success {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
    }
    
    .btn-success:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(40, 167, 69, 0.4);
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }
    
    .badge {
        display: inline-block;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
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
    
    .notes-list {
        list-style: none;
        padding: 0;
    }
    
    .notes-list li {
        padding: 15px;
        margin-bottom: 10px;
        border-left: 4px solid #28a745;
        background-color: #f8f9fa;
        border-radius: 5px;
    }
</style>

@php
    $downloadUrl = $download_url ?? null;
    $dashboardUrl = $dashboard_url ?? null;
@endphp

<div class="quotation-container">
    <div class="quotation-header">
        <i class="fas fa-check-circle"></i>
        <h1>QUOTATION SIGNED SUCCESSFULLY</h1>
        <div class="subtitle">Quote No: WO-{{ str_pad($work_order['id'], 6, '0', STR_PAD_LEFT) }}</div>
    </div>
    
    <div class="quotation-body">
        <div class="success-message">
            <h2><i class="fas fa-thumbs-up"></i> Thank You!</h2>
            <p>Your quotation has been signed and submitted successfully.</p>
            <p>A copy of the signed document is available for download below.</p>
        </div>
        
        <!-- Signature Section -->
        <div class="section">
            <div class="section-title"><i class="fas fa-signature"></i> SIGNATURE DETAILS</div>
            <div class="signature-display">
                <img src="{{ $signature->signature_data }}" alt="Signature">
                <div class="signature-info">
                    <p><strong>Signed by:</strong> {{ $signature->signer_name }}</p>
                    @if($signature->signer_email)
                    <p><strong>Email:</strong> {{ $signature->signer_email }}</p>
                    @endif
                    <p><strong>Date & Time:</strong> {{ date('m/d/Y H:i', strtotime($signature->signed_at)) }}</p>
                    <p><strong>IP Address:</strong> {{ $signature->ip_address }}</p>
                </div>
            </div>
        </div>
        
        <!-- Customer Information -->
        <div class="section">
            <div class="section-title"><i class="fas fa-user"></i> CUSTOMER INFORMATION</div>
            <table class="info-table">
                <tr>
                    <td class="label">Customer Name</td>
                    <td>{{ $work_order['customer']['first_name'] }} {{ $work_order['customer']['last_name'] }}</td>
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
            <div class="section-title"><i class="fas fa-clipboard-list"></i> WORK ORDER DETAILS</div>
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
            <div class="section-title"><i class="fas fa-sticky-note"></i> NOTES & OBSERVATIONS</div>
            <ul class="notes-list">
                @foreach($work_order['notes'] as $note)
                <li>
                    @if(!empty($note['note_type']))
                    <strong style="color: #28a745; text-transform: uppercase; font-size: 12px;">{{ $note['note_type'] }}</strong><br/>
                    @endif
                    {{ $note['note'] }}
                    @if(!empty($note['created_at']))
                    <br/><small style="color: #999;">Added: {{ date('m/d/Y H:i', strtotime($note['created_at'])) }}</small>
                    @endif
                </li>
                @endforeach
            </ul>
        </div>
        @endif
        
        <!-- Photos Section -->
        @if(!empty($work_order['photos']) && count($work_order['photos']) > 0)
        <div class="section">
            <div class="section-title"><i class="fas fa-images"></i> ATTACHED PHOTOS</div>
            <table class="info-table">
                <tr>
                    <td class="label">Total Photos</td>
                    <td>{{ count($work_order['photos']) }} photo(s) attached to this work order</td>
                </tr>
            </table>
        </div>
        @endif
        
        <!-- Action Buttons -->
        <div class="action-buttons">
            @if($downloadUrl)
            <a href="{{ $downloadUrl }}" class="btn btn-success">
                <i class="fas fa-download"></i> Download Signed PDF
            </a>
            @endif
            @if($dashboardUrl)
            <a href="{{ $dashboardUrl }}" class="btn btn-primary">
                <i class="fas fa-home"></i> Return to Dashboard
            </a>
            @else
            <button type="button" class="btn btn-primary" onclick="window.close();">
                <i class="fas fa-window-close"></i> Close This Window
            </button>
            @endif
        </div>
    </div>
</div>

@include('partials.single-page.footer')

