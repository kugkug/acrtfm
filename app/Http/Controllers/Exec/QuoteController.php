<?php

namespace App\Http\Controllers\Exec;

use App\Http\Controllers\Controller;
use App\Mail\QuotationSignatureRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class QuoteController extends Controller
{
    private $data = [];

    public function __construct() {
        $this->data = [
            'theme' => 'light',
            'root_url' => URL::current(),
        ];
    }
    
    /**
     * Display the quotation for e-signature (authenticated users)
     */
    public function showQuotationForSignature($id)
    {
        try {
            $this->data['title'] = 'Quote - E-Signature'; 
            $this->data['header'] = "Quote - E-Signature";
            $this->data['description'] = "Sign the quotation";
            
            $work_order = globalHelper()->getWorkOrder($id);
            
            if (empty($work_order)) {
                return redirect()->route('work-orders')->with('error', 'Work Order not found');
            }

            $existingSignature = DB::table('signatures')
                ->where([
                    ['signatureable_type', '=', \App\Models\WorkOrder::class],
                    ['signatureable_id', '=', $id],
                ])
                ->orderByDesc('id')
                ->first();

            $this->data['work_order'] = $work_order;
            $this->data['existing_signature'] = $existingSignature;
            $this->data['signature_save_url'] = route('quotation.save-signature', ['id' => $id]);
            $this->data['signature_context'] = 'internal';

            return view('pages.client.quotation.sign', $this->data);
        } catch(\Exception $e) {
            logInfo($e->getTraceAsString());
            return redirect()->back()->with('error', 'Failed to load quotation: ' . $e->getMessage());
        }
    }

    /**
     * Display the quotation for e-signature (public signed URL)
     */
    public function showQuotationForSignaturePublic(Request $request, $id)
    {
        try {
            $this->data['title'] = 'Quote - E-Signature'; 
            $this->data['header'] = "Quote - E-Signature";
            $this->data['description'] = "Sign the quotation";
            
            $work_order = globalHelper()->getWorkOrder($id);
            
            if (empty($work_order)) {
                abort(404);
            }

            $existingSignature = DB::table('signatures')
                ->where([
                    ['signatureable_type', '=', \App\Models\WorkOrder::class],
                    ['signatureable_id', '=', $id],
                ])
                ->orderByDesc('id')
                ->first();

            $this->data['work_order'] = $work_order;
            $this->data['existing_signature'] = $existingSignature;
            $this->data['signature_save_url'] = URL::temporarySignedRoute(
                'quotation.public-save-signature',
                now()->addMinutes(60),
                ['id' => $id]
            );
            $this->data['signature_context'] = 'public';

            return view('pages.client.quotation.sign', $this->data);
        } catch(\Exception $e) {
            logInfo($e->getTraceAsString());
            abort(500, 'Failed to load quotation for signature.');
        }
    }

    /**
     * Save the signature
     */
    public function saveSignature(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'signature' => 'required|string',
                'signer_name' => 'required|string|max:255',
                'signer_email' => 'nullable|email|max:255',
                'signature_context' => 'nullable|in:internal,public',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'error' => $validator->errors()->first()
                ], 422);
            }

            $work_order = globalHelper()->getWorkOrder($id);
            
            if (empty($work_order)) {
                return response()->json(['error' => 'Work Order not found'], 404);
            }

            $existingSignature = DB::table('signatures')
                ->where('signatureable_type', \App\Models\WorkOrder::class)
                ->where('signatureable_id', $id)
                ->first();

            if ($existingSignature) {
                return response()->json(['error' => 'This quote has already been signed'], 400);
            }

            DB::table('signatures')->insert([
                'signatureable_type' => \App\Models\WorkOrder::class,
                'signatureable_id' => $id,
                'signature_data' => $request->signature,
                'signer_name' => $request->signer_name,
                'signer_email' => $request->signer_email,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'signed_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $context = $request->input('signature_context', 'internal');
            $redirectUrl = $context === 'public'
                ? URL::temporarySignedRoute('quotation.public-signed', now()->addMinutes(60), ['id' => $id])
                : route('quotation.signed', ['id' => $id]);

            return response()->json([
                'success' => true,
                'message' => 'Quote signed successfully',
                'redirect' => $redirectUrl
            ]);

        } catch(\Exception $e) {
            logInfo($e->getTraceAsString());
            return response()->json(['error' => 'Failed to save signature: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Send email invitation for quotation signature
     */
    public function sendSignatureLink(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'signature_email' => 'required|email|max:255',
            ]);

            if ($validator->fails()) {
                $message = addslashes($validator->errors()->first('signature_email'));
                return response()->json([
                    'js' => "
                        var button = $('#sendSignatureEmailButton');
                        var defaultText = button.data('default-text') || 'Send Signature Link';
                        button.prop('disabled', false).html(defaultText);
                        _show_toastr('error', '{$message}', 'Validation Error');
                    "
                ]);
            }

            $work_order = globalHelper()->getWorkOrder($id);
            
            if (empty($work_order)) {
                return response()->json([
                    'js' => "
                        var button = $('#sendSignatureEmailButton');
                        var defaultText = button.data('default-text') || 'Send Signature Link';
                        button.prop('disabled', false).html(defaultText);
                        _show_toastr('error', 'Work Order not found', 'System Error');
                    "
                ]);
            }

            $signatureEmail = $request->input('signature_email');
            $expiresAt = now()->addDays(7);
            $signUrl = URL::temporarySignedRoute(
                'quotation.public-sign',
                $expiresAt,
                ['id' => $id]
            );

            if (!empty($work_order['customer']['id'])) {
                $customer = Customer::find($work_order['customer']['id']);
                if ($customer && empty($customer->email)) {
                    $customer->email = $signatureEmail;
                    $customer->save();
                }
            }

            $sender = auth()->user();
            Mail::to($signatureEmail)->send(
                new QuotationSignatureRequest($work_order, $signUrl, $expiresAt, $sender)
            );

            $message = 'Quote signature link sent successfully.';
            return globalHelper()->ajaxSuccessResponse(
                'scripts',
                'success',
                'quotation-signature-link-sent',
                $message,
                'System Info',
                [
                    'modal_selector' => '#signatureOptionsModal',
                    'button_selector' => '#sendSignatureEmailButton',
                    'email' => $signatureEmail,
                    'default_button_text' => 'Send Signature Link',
                ]
            );
        } catch (\Exception $e) {
            logInfo($e->getTraceAsString());
            $message = addslashes('Failed to send signature link: ' . $e->getMessage());
            return response()->json([
                'js' => "
                    var button = $('#sendSignatureEmailButton');
                    var defaultText = button.data('default-text') || 'Send Signature Link';
                    button.prop('disabled', false).html(defaultText);
                    _show_toastr('error', '{$message}', 'System Error');
                "
            ]);
        }
    }

    /**
     * Display signed quotation confirmation (authenticated users)
     */
    public function showSignedQuotation($id)
    {
        try {
            $work_order = globalHelper()->getWorkOrder($id);
            
            if (empty($work_order)) {
                return redirect()->route('work-orders')->with('error', 'Work Order not found');
            }

            $signature = DB::table('signatures')
                ->where('signatureable_type', \App\Models\WorkOrder::class)
                ->where('signatureable_id', $id)
                ->first();

            if (!$signature) {
                return redirect()->route('quotation.sign', ['id' => $id])
                    ->with('error', 'This quote has not been signed yet');
            }

            $this->data['title'] = 'Signed Quote';
            $this->data['work_order'] = $work_order;
            $this->data['signature'] = $signature;
            $this->data['description'] = "Signed quotation";
            $this->data['download_url'] = route('quotation.download', ['id' => $id]);
            $this->data['dashboard_url'] = route('home');

            return view('pages.client.quotation.signed', $this->data);
        } catch(\Exception $e) {
            logInfo($e->getTraceAsString());
            return redirect()->back()->with('error', 'Failed to load quotation: ' . $e->getMessage());
        }
    }

    /**
     * Display signed quotation confirmation (public signed URL)
     */
    public function showSignedQuotationPublic($id)
    {
        try {
            $work_order = globalHelper()->getWorkOrder($id);
            
            if (empty($work_order)) {
                abort(404);
            }

            $signature = DB::table('signatures')
                ->where('signatureable_type', \App\Models\WorkOrder::class)
                ->where('signatureable_id', $id)
                ->first();

            if (!$signature) {
                abort(404);
            }

            $this->data['title'] = 'Signed Quote';
            $this->data['work_order'] = $work_order;
            $this->data['signature'] = $signature;
            $this->data['description'] = "Signed quotation";
            $this->data['download_url'] = URL::temporarySignedRoute(
                'quotation.public-download',
                now()->addMinutes(60),
                ['id' => $id]
            );
            $this->data['dashboard_url'] = null;

            return view('pages.client.quotation.signed', $this->data);
        } catch(\Exception $e) {
            logInfo($e->getTraceAsString());
            abort(500, 'Failed to load signed quotation.');
        }
    }

    /**
     * Download signed quotation as PDF (authenticated users)
     */
    public function downloadSignedQuotation($id)
    {
        try {
            $work_order = globalHelper()->getWorkOrder($id);
            
            if (empty($work_order)) {
                return redirect()->route('work-orders')->with('error', 'Work Order not found');
            }

            $signature = DB::table('signatures')
                ->where('signatureable_type', \App\Models\WorkOrder::class)
                ->where('signatureable_id', $id)
                ->first();

            if (!$signature) {
                return redirect()->back()->with('error', 'This quote has not been signed yet');
            }

            return $this->downloadSignedQuotationPdf($work_order, $signature);
        } catch(\Exception $e) {
            logInfo($e->getTraceAsString());
            return redirect()->back()->with('error', 'Failed to generate PDF: ' . $e->getMessage());
        }
    }

    /**
     * Download signed quotation as PDF (public signed URL)
     */
    public function downloadSignedQuotationPublic($id)
    {
        try {
            $work_order = globalHelper()->getWorkOrder($id);
            
            if (empty($work_order)) {
                abort(404);
            }

            $signature = DB::table('signatures')
                ->where('signatureable_type', \App\Models\WorkOrder::class)
                ->where('signatureable_id', $id)
                ->first();

            if (!$signature) {
                abort(404);
            }

            return $this->downloadSignedQuotationPdf($work_order, $signature);
        } catch(\Exception $e) {
            logInfo($e->getTraceAsString());
            abort(500, 'Failed to generate PDF.');
        }
    }

    /**
     * Generate the signed quotation PDF download response
     */
    protected function downloadSignedQuotationPdf(array $work_order, $signature)
    {
        $pdf = \PDF::loadView('pdf.quotation-signed', [
            'work_order' => $work_order,
            'signature' => $signature
        ]);
        
        $filename = 'signed_quotation_WO-' . str_pad($work_order['id'], 6, '0', STR_PAD_LEFT) . '_' . date('Ymd') . '.pdf';
        
        return $pdf->download($filename);
    }
}