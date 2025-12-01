# Integration Examples for E-Signature Feature

This document provides ready-to-use code snippets for integrating the quotation e-signature feature into your existing views.

## 1. Add Button to Work Order View Page

Add this to your work order view page (e.g., `resources/views/pages/client/tech_dispatch/work_orders/view.blade.php`):

```blade
<!-- E-Signature Button -->
@php
    $signature = \DB::table('signatures')
        ->where('signatureable_type', 'App\Models\WorkOrder')
        ->where('signatureable_id', $work_order['id'])
        ->first();
@endphp

<div class="signature-action-section">
    @if($signature)
        <!-- Already Signed -->
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            <strong>Signed!</strong> This quotation was signed on
            {{ date('M d, Y \a\t h:i A', strtotime($signature->signed_at)) }}
            by {{ $signature->signer_name }}
        </div>
        <div class="btn-group">
            <a href="{{ route('quotation.signed', ['id' => $work_order['id']]) }}"
               class="btn btn-success">
                <i class="fas fa-eye"></i> View Signed Document
            </a>
            <a href="{{ route('quotation.download', ['id' => $work_order['id']]) }}"
               class="btn btn-primary">
                <i class="fas fa-download"></i> Download PDF
            </a>
        </div>
    @else
        <!-- Not Signed Yet -->
        <div class="alert alert-warning">
            <i class="fas fa-exclamation-triangle"></i>
            <strong>Pending Signature</strong> This quotation requires customer signature
        </div>
        <a href="{{ route('quotation.sign', ['id' => $work_order['id']]) }}"
           class="btn btn-info btn-lg">
            <i class="fas fa-signature"></i> Sign Quote Now
        </a>
    @endif
</div>
```

## 2. Add Status Badge to Work Order List

Add this to your work order listing page (e.g., `resources/views/pages/client/tech_dispatch/work_orders/index.blade.php`):

```blade
@foreach($work_orders as $work_order)
    <tr>
        <td>WO-{{ str_pad($work_order->id, 6, '0', STR_PAD_LEFT) }}</td>
        <td>{{ $work_order->title }}</td>
        <td>{{ $work_order->customer->first_name }} {{ $work_order->customer->last_name }}</td>

        <!-- Signature Status Column -->
        <td>
            @php
                $signature = \DB::table('signatures')
                    ->where('signatureable_type', 'App\Models\WorkOrder')
                    ->where('signatureable_id', $work_order->id)
                    ->first();
            @endphp

            @if($signature)
                <span class="badge badge-success" title="Signed on {{ date('M d, Y', strtotime($signature->signed_at)) }}">
                    <i class="fas fa-check-circle"></i> Signed
                </span>
            @else
                <span class="badge badge-warning">
                    <i class="fas fa-clock"></i> Pending
                </span>
            @endif
        </td>

        <!-- Actions Column -->
        <td>
            @if($signature)
                <a href="{{ route('quotation.signed', ['id' => $work_order->id]) }}"
                   class="btn btn-sm btn-success" title="View Signed">
                    <i class="fas fa-file-signature"></i>
                </a>
            @else
                <a href="{{ route('quotation.sign', ['id' => $work_order->id]) }}"
                   class="btn btn-sm btn-info" title="Sign Now">
                    <i class="fas fa-signature"></i>
                </a>
            @endif
        </td>
    </tr>
@endforeach
```

## 3. Add Link to Generate Quote Button

Modify your existing generate quotation button to also include signature option:

```blade
<div class="quotation-actions">
    <!-- Existing PDF Generation -->
    <a href="{{ route('exec-work-orders-generate-quotation', ['id' => $work_order['id']]) }}"
       class="btn btn-secondary">
        <i class="fas fa-file-pdf"></i> Download PDF (Unsigned)
    </a>

    <!-- New E-Signature Option -->
    <a href="{{ route('quotation.sign', ['id' => $work_order['id']]) }}"
       class="btn btn-primary">
        <i class="fas fa-signature"></i> E-Sign Quote
    </a>
</div>
```

## 4. Email Template with Signature Link

Create an email template to send to customers:

```blade
<!-- resources/views/emails/quotation-ready.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Quote Ready for Signature</title>
</head>
<body style="font-family: Arial, sans-serif; padding: 20px;">
    <div style="max-width: 600px; margin: 0 auto;">
        <h2 style="color: #667eea;">Your Quote is Ready</h2>

        <p>Dear {{ $customer_name }},</p>

        <p>Your work order quotation (WO-{{ str_pad($work_order_id, 6, '0', STR_PAD_LEFT) }}) is ready for your review and signature.</p>

        <p><strong>Work Order Details:</strong></p>
        <ul>
            <li>Title: {{ $work_order_title }}</li>
            <li>Scheduled: {{ $schedule_date }}</li>
        </ul>

        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ route('quotation.sign', ['id' => $work_order_id]) }}"
               style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                      color: white;
                      padding: 15px 30px;
                      text-decoration: none;
                      border-radius: 8px;
                      display: inline-block;
                      font-weight: bold;">
                Review and Sign Quote
            </a>
        </div>

        <p style="color: #666; font-size: 12px;">
            This link will allow you to review the quotation details and provide your electronic signature.
        </p>
    </div>
</body>
</html>
```

## 5. Add Signature Status to Dashboard Widget

```blade
<!-- Dashboard Widget for Pending Signatures -->
<div class="dashboard-widget">
    <h3><i class="fas fa-signature"></i> Pending Signatures</h3>

    @php
        $pending_signatures = \App\Models\WorkOrder::whereNotIn('id', function($query) {
            $query->select('signatureable_id')
                  ->from('signatures')
                  ->where('signatureable_type', 'App\Models\WorkOrder');
        })
        ->where('created_by', auth()->id())
        ->where('status', '!=', 'completed')
        ->limit(5)
        ->get();
    @endphp

    @if($pending_signatures->count() > 0)
        <ul class="pending-list">
            @foreach($pending_signatures as $wo)
                <li>
                    <div class="wo-info">
                        <strong>WO-{{ str_pad($wo->id, 6, '0', STR_PAD_LEFT) }}</strong>
                        <span>{{ $wo->title }}</span>
                    </div>
                    <a href="{{ route('quotation.sign', ['id' => $wo->id]) }}"
                       class="btn btn-sm btn-info">
                        Sign Now
                    </a>
                </li>
            @endforeach
        </ul>
    @else
        <p class="text-muted">No pending signatures</p>
    @endif
</div>
```

## 6. Helper Function for Signature Status

Create a helper function in `app/Helpers/helpers.php`:

```php
/**
 * Check if a work order quotation has been signed
 *
 * @param int $work_order_id
 * @return object|null
 */
function getQuoteSignature($work_order_id) {
    return \DB::table('signatures')
        ->where('signatureable_type', 'App\Models\WorkOrder')
        ->where('signatureable_id', $work_order_id)
        ->first();
}

/**
 * Check if a work order quotation is signed
 *
 * @param int $work_order_id
 * @return bool
 */
function isQuoteSigned($work_order_id) {
    return getQuoteSignature($work_order_id) !== null;
}
```

Usage:

```blade
@if(isQuoteSigned($work_order['id']))
    <span class="badge badge-success">Signed</span>
@else
    <a href="{{ route('quotation.sign', ['id' => $work_order['id']]) }}">Sign Now</a>
@endif
```

## 7. Add to Work Order Model

Add this method to `app/Models/WorkOrder.php`:

```php
use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * Get the signature for the work order quotation
 */
public function signature(): MorphOne
{
    return $this->morphOne(\Creagia\LaravelSignPad\Models\Signature::class, 'signatureable');
}

/**
 * Check if quotation is signed
 */
public function isSigned(): bool
{
    return $this->signature()->exists();
}

/**
 * Get signature data
 */
public function getSignature()
{
    return $this->signature;
}
```

Usage in views:

```blade
@if($work_order->isSigned())
    <span class="badge badge-success">Signed</span>
@else
    <a href="{{ route('quotation.sign', ['id' => $work_order->id]) }}">Sign Now</a>
@endif
```

## 8. JavaScript to Share Signature Link

Add a "Copy Link" button:

```blade
<button onclick="copySignatureLink({{ $work_order['id'] }})" class="btn btn-outline-primary">
    <i class="fas fa-link"></i> Copy Signature Link
</button>

<script>
function copySignatureLink(workOrderId) {
    const url = "{{ url('/') }}/quotation/" + workOrderId + "/sign";

    navigator.clipboard.writeText(url).then(function() {
        alert('Signature link copied to clipboard!');
    }, function(err) {
        console.error('Could not copy text: ', err);
    });
}
</script>
```

## 9. QR Code for Mobile Signing

Generate a QR code for easy mobile access:

```blade
<!-- Add this package: composer require simplesoftwareio/simple-qrcode -->

<div class="qr-code-section">
    <h4>Scan to Sign on Mobile</h4>
    {!! QrCode::size(200)->generate(route('quotation.sign', ['id' => $work_order['id']])) !!}
    <p>Scan this QR code with your mobile device to sign the quotation</p>
</div>
```

## 10. Notification System Integration

Add to your notification preferences:

```php
// In your notification controller or service
public function sendSignatureRequest($work_order) {
    $customer = $work_order->customer;
    $signature_url = route('quotation.sign', ['id' => $work_order->id]);

    // Send email
    Mail::to($customer->email)->send(new SignatureRequestMail($work_order, $signature_url));

    // Send SMS (if you have SMS integration)
    // SMS::send($customer->phone, "Please sign your quotation: $signature_url");

    return response()->json(['message' => 'Signature request sent successfully']);
}
```

---

## Styling Tips

Add these CSS classes to your main stylesheet:

```css
.signature-action-section {
    margin: 20px 0;
    padding: 20px;
    background: #f8f9fa;
    border-radius: 8px;
}

.badge-signed {
    background-color: #28a745;
    color: white;
}

.badge-pending {
    background-color: #ffc107;
    color: #333;
}

.pending-list {
    list-style: none;
    padding: 0;
}

.pending-list li {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px;
    border-bottom: 1px solid #dee2e6;
}

.wo-info {
    display: flex;
    flex-direction: column;
}
```

---

**Note**: These examples are ready to use. Just copy and paste into your views, adjusting as needed for your specific layout and design.
