<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class QuotationSignatureRequest extends Mailable
{
    use Queueable, SerializesModels;

    public array $workOrder;
    public string $signUrl;
    public \Carbon\Carbon $expiresAt;
    public ?\App\Models\User $sender;

    /**
     * Create a new message instance.
     */
    public function __construct(array $workOrder, string $signUrl, \Carbon\Carbon $expiresAt, ?\App\Models\User $sender = null)
    {
        $this->workOrder = $workOrder;
        $this->signUrl = $signUrl;
        $this->expiresAt = $expiresAt;
        $this->sender = $sender;
    }

    /**
     * Build the message.
     */
    public function build(): self
    {
        $customerName = trim(($this->workOrder['customer']['first_name'] ?? '') . ' ' . ($this->workOrder['customer']['last_name'] ?? ''));
        $subject = 'Quotation Signature Request';

        if (!empty($customerName)) {
            $subject = "{$customerName} - {$subject}";
        }

        return $this->subject($subject)
            ->view('emails.quotation.signature-request')
            ->with([
                'workOrder' => $this->workOrder,
                'signUrl' => $this->signUrl,
                'expiresAt' => $this->expiresAt,
                'sender' => $this->sender,
            ]);
    }
}

