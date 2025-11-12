# Quotation E-Signature Feature Guide

This guide explains how to use the new quotation e-signature feature implemented using the `creagia/laravel-sign-pad` package.

## Overview

The quotation e-signature feature allows customers to electronically sign work order quotations. The system captures the signature, stores it securely in the database, and generates a signed PDF document.

## Features

- ✅ Electronic signature capture using HTML5 Canvas
- ✅ Secure signature storage with IP address and timestamp
- ✅ Beautiful, responsive UI for signature collection
- ✅ Prevents duplicate signatures
- ✅ Generates signed PDF documents
- ✅ Tracks signer information (name, email, IP, timestamp)
- ✅ Mobile-friendly signature pad

## Installation

The package has been installed and configured:

1. **Package**: `creagia/laravel-sign-pad` v2.1.3
2. **Database**: Signatures table migration has been run
3. **Assets**: Published to `public/vendor/sign-pad`
4. **Configuration**: Published to `config/sign-pad.php`

## Routes

The following routes have been added:

| Route | Method | Description |
|-------|--------|-------------|
| `/quotation/{id}/sign` | GET | Display quotation for signature |
| `/quotation/{id}/signature` | POST | Save the signature |
| `/quotation/{id}/signed` | GET | Display signed quotation |
| `/quotation/{id}/download` | GET | Download signed PDF |

## Usage

### 1. Linking to the Signature Page

To add a link to the signature page in your work order views, use:

```blade
<a href="{{ route('quotation.sign', ['id' => $work_order_id]) }}" class="btn btn-primary">
    <i class="fas fa-signature"></i> Sign Quotation
</a>
```

### 2. Example: Adding to Work Order View

In `resources/views/pages/client/tech_dispatch/work_orders/view.blade.php`:

```blade
<div class="action-buttons">
    <!-- Existing buttons -->
    
    <!-- Add signature button -->
    <a href="{{ route('quotation.sign', ['id' => $work_order['id']]) }}" 
       class="btn btn-info">
        <i class="fas fa-signature"></i> E-Sign Quotation
    </a>
</div>
```

### 3. Checking if Quotation is Signed

To check if a quotation has been signed:

```php
$signature = \DB::table('signatures')
    ->where('signatureable_type', 'App\Models\WorkOrder')
    ->where('signatureable_id', $work_order_id)
    ->first();

if ($signature) {
    // Quotation is signed
    // Display signed badge or redirect to signed page
}
```

### 4. Displaying Signature Status in Work Order List

```blade
@php
    $signature = \DB::table('signatures')
        ->where('signatureable_type', 'App\Models\WorkOrder')
        ->where('signatureable_id', $work_order['id'])
        ->first();
@endphp

@if($signature)
    <span class="badge badge-success">
        <i class="fas fa-check-circle"></i> Signed
    </span>
@else
    <span class="badge badge-warning">
        <i class="fas fa-clock"></i> Awaiting Signature
    </span>
@endif
```

## Controller Methods

### QuoteController Methods

1. **showQuotationForSignature($id)**: Displays the quotation with signature pad
2. **saveSignature(Request $request, $id)**: Saves the signature to database
3. **showSignedQuotation($id)**: Displays the signed quotation confirmation
4. **downloadSignedQuotation($id)**: Generates and downloads signed PDF

## Database Schema

The signatures table stores:

- `id`: Primary key
- `signatureable_type`: Polymorphic relation type (e.g., 'App\Models\WorkOrder')
- `signatureable_id`: Related model ID
- `signature_data`: Base64 encoded signature image
- `signer_name`: Name of the person who signed
- `signer_email`: Email of the signer (optional)
- `ip_address`: IP address from which signature was created
- `user_agent`: Browser user agent
- `signed_at`: Timestamp of signature
- `created_at` / `updated_at`: Laravel timestamps

## Views

### 1. Sign View (`resources/views/pages/client/quotation/sign.blade.php`)
- Displays quotation details
- Shows signature pad
- Captures signer information
- Validates signature before submission

### 2. Signed View (`resources/views/pages/client/quotation/signed.blade.php`)
- Confirmation page after signing
- Shows signature details
- Provides download option
- Displays complete quotation

### 3. Signed PDF (`resources/views/pdf/quotation-signed.blade.php`)
- PDF template with signature
- Includes verification information
- Shows complete work order details

## Security Features

1. **Duplicate Prevention**: System checks if quotation is already signed
2. **IP Tracking**: Records IP address for each signature
3. **Timestamp**: Records exact date and time of signature
4. **User Agent**: Captures browser information
5. **CSRF Protection**: All forms include CSRF tokens

## Customization

### Changing Signature Pad Colors

In `resources/views/pages/client/quotation/sign.blade.php`, modify:

```javascript
const signaturePad = new SignaturePad(canvas, {
    backgroundColor: 'rgb(255, 255, 255)', // White background
    penColor: 'rgb(0, 0, 0)' // Black pen
});
```

### Modifying Email Notifications

You can add email notifications when a quotation is signed by adding to `QuoteController::saveSignature()`:

```php
// Send notification email
Mail::to($work_order['customer']['email'])
    ->send(new QuotationSignedMail($work_order, $signature));
```

## Testing

To test the e-signature feature:

1. Navigate to `/quotation/{work_order_id}/sign`
2. Fill in signer name and email
3. Draw signature in the pad
4. Click "Sign and Submit"
5. Verify redirection to signed confirmation page
6. Download the signed PDF

## Example URL

For work order with ID 1:
- Sign: `https://yourdomain.com/quotation/1/sign`
- Signed: `https://yourdomain.com/quotation/1/signed`
- Download: `https://yourdomain.com/quotation/1/download`

## Common Issues

### Issue: Canvas not displaying
**Solution**: Ensure Font Awesome icons are loaded in the layout

### Issue: Signature not saving
**Solution**: Check that signatures table migration has been run

### Issue: PDF generation fails
**Solution**: Ensure `barryvdh/laravel-dompdf` package is installed

## Future Enhancements

Potential improvements:
- Email notification upon signature
- Multiple signers support
- SMS verification before signing
- Signature verification API
- Signature expiration dates
- Custom signature templates

## Support

For issues or questions, refer to:
- [creagia/laravel-sign-pad Documentation](https://github.com/creagia/laravel-sign-pad)
- Laravel Documentation
- Your internal development team

---

**Created**: November 2, 2025
**Version**: 1.0
**Package**: creagia/laravel-sign-pad v2.1.3

