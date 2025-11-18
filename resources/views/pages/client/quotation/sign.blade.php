@include('partials.single-page.header')

<style>
    body {
        /* background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); */
        min-height: 100vh;
        /* padding: 20px 0; */
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
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 30px;
        text-align: center;
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
    
    .section {
        margin-bottom: 30px;
    }
    
    .section-title {
        background-color: #f8f9fa;
        border-left: 4px solid #667eea;
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
        border-left: 4px solid #667eea;
        background-color: #f8f9fa;
        border-radius: 5px;
    }
    
    .signature-section {
        background-color: #f8f9fa;
        padding: 30px;
        border-radius: 10px;
        margin-top: 30px;
    }
    
    .signature-pad-container {
        background: white;
        border: 2px solid #dee2e6;
        border-radius: 8px;
        overflow: hidden;
        margin: 20px 0;
    }
    
    canvas {
        display: block;
        touch-action: none;
    }
    
    .signature-controls {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
    }
    
    .btn {
        padding: 12px 24px;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }
    
    .btn-secondary {
        background-color: #6c757d;
        color: white;
    }
    
    .btn-secondary:hover {
        background-color: #5a6268;
    }
    
    .form-group {
        margin-bottom: 20px;
    }
    
    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #495057;
    }
    
    .form-control {
        width: 100%;
        padding: 12px;
        border: 2px solid #dee2e6;
        border-radius: 8px;
        font-size: 14px;
    }
    
    .form-control:focus {
        outline: none;
        border-color: #667eea;
    }
    
    .alert {
        padding: 15px 20px;
        border-radius: 8px;
        margin-bottom: 20px;
    }
    
    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }
    
    .alert-warning {
        background-color: #fff3cd;
        color: #856404;
        border: 1px solid #ffeaa7;
    }
    
    .alert-error {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }
    
    .already-signed {
        text-align: center;
        padding: 40px;
    }
    
    .already-signed i {
        font-size: 64px;
        color: #28a745;
        margin-bottom: 20px;
    }
</style>

<div class="quotation-container">
    <div class="quotation-header">
        <h1>WORK ORDER QUOTATION</h1>
        <div class="subtitle">Quote No: WO-{{ str_pad($work_order['id'], 6, '0', STR_PAD_LEFT) }}</div>
        <div style="margin-top: 10px; font-size: 14px; opacity: 0.8;">
            Generated on: {{ date('m/d/Y H:i') }}
        </div>
    </div>
    
    <div class="quotation-body">
        @if(session('error'))
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
        @endif
        
        @if($existing_signature)
        <div class="already-signed">
            <i class="fas fa-check-circle"></i>
            <h2>This Quotation Has Been Signed</h2>
            <p>This quotation was signed on {{ date('m/d/Y H:i', strtotime($existing_signature->signed_at)) }}</p>
            <p><strong>Signed by:</strong> {{ $existing_signature->signer_name }}</p>
            <a href="{{ route('quotation.signed', ['id' => $work_order['id']]) }}" class="btn btn-primary">
                <i class="fas fa-file-alt"></i> View Signed Document
            </a>
        </div>
        @else
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
                    <strong style="color: #667eea; text-transform: uppercase; font-size: 12px;">{{ $note['note_type'] }}</strong><br/>
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
        
        <!-- Signature Section -->
        <div class="signature-section">
            <div class="section-title"><i class="fas fa-signature"></i> ELECTRONIC SIGNATURE</div>
            <p style="margin-bottom: 20px; color: #6c757d;">
                By signing below, you acknowledge that you have reviewed and agree to the work order details outlined above.
            </p>
            
            <div id="errorMessage" class="alert alert-error" style="display: none;"></div>
            
            <form id="signatureForm">
                @csrf
                <input type="hidden" id="signature_context" value="{{ $signature_context ?? 'internal' }}">
                <div class="form-group">
                    <label for="signer_name">Full Name <span style="color: red;">*</span></label>
                    <input type="text" id="signer_name" name="signer_name" class="form-control" required
                           value="{{ $work_order['customer']['first_name'] ?? '' }} {{ $work_order['customer']['last_name'] ?? '' }}">
                </div>
                
                <div class="form-group">
                    <label for="signer_email">Email Address</label>
                    <input type="email" id="signer_email" name="signer_email" class="form-control"
                           value="{{ $work_order['customer']['email'] ?? '' }}">
                </div>
                
                <div class="form-group">
                    <label>Signature <span style="color: red;">*</span></label>
                    <p style="font-size: 13px; color: #6c757d; margin-bottom: 10px;">
                        Please sign in the box below using your mouse or touch screen
                    </p>
                    <div class="signature-pad-container">
                        <canvas id="signaturePad" width="800" height="200"></canvas>
                    </div>
                    <div class="signature-controls">
                        <button type="button" id="clearButton" class="btn btn-secondary">
                            <i class="fas fa-eraser"></i> Clear Signature
                        </button>
                    </div>
                </div>
                
                <button type="submit" id="submitButton" class="btn btn-primary" style="width: 100%; font-size: 16px;">
                    <i class="fas fa-check-circle"></i> Sign and Submit
                </button>
            </form>
        </div>
        @endif
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
<script>
    const canvas = document.getElementById('signaturePad');
    if (canvas) {
        const signaturePad = new SignaturePad(canvas, {
            backgroundColor: 'rgb(255, 255, 255)',
            penColor: 'rgb(0, 0, 0)'
        });
        const saveSignatureUrl = @json($signature_save_url ?? route('quotation.save-signature', ['id' => $work_order['id']]));
        const signatureContext = document.getElementById('signature_context').value || 'internal';
        
        // Clear button
        document.getElementById('clearButton').addEventListener('click', function() {
            signaturePad.clear();
        });
        
        // Form submission
        document.getElementById('signatureForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            // Hide error message
            document.getElementById('errorMessage').style.display = 'none';
            
            // Validate signature
            if (signaturePad.isEmpty()) {
                document.getElementById('errorMessage').textContent = 'Please provide a signature before submitting.';
                document.getElementById('errorMessage').style.display = 'block';
                return;
            }
            
            // Validate name
            const signerName = document.getElementById('signer_name').value.trim();
            if (!signerName) {
                document.getElementById('errorMessage').textContent = 'Please provide your full name.';
                document.getElementById('errorMessage').style.display = 'block';
                return;
            }
            
            // Get signature data
            const signatureData = signaturePad.toDataURL();
            
            // Prepare form data
            const formData = new FormData();
            formData.append('signature', signatureData);
            formData.append('signer_name', signerName);
            formData.append('signer_email', document.getElementById('signer_email').value);
            formData.append('_token', document.querySelector('input[name="_token"]').value);
            formData.append('signature_context', signatureContext);
            
            // Disable submit button
            const submitButton = document.getElementById('submitButton');
            submitButton.disabled = true;
            submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Submitting...';
            
            try {
                const response = await fetch(saveSignatureUrl, {
                    method: 'POST',
                    body: formData
                });
                
                const result = await response.json();
                
                if (result.success) {
                    window.location.href = result.redirect;
                } else {
                    document.getElementById('errorMessage').textContent = result.error || 'An error occurred while saving the signature.';
                    document.getElementById('errorMessage').style.display = 'block';
                    submitButton.disabled = false;
                    submitButton.innerHTML = '<i class="fas fa-check-circle"></i> Sign and Submit';
                }
            } catch (error) {
                document.getElementById('errorMessage').textContent = 'An error occurred. Please try again.';
                document.getElementById('errorMessage').style.display = 'block';
                submitButton.disabled = false;
                submitButton.innerHTML = '<i class="fas fa-check-circle"></i> Sign and Submit';
            }
        });
    }
</script>

@include('partials.single-page.footer')

