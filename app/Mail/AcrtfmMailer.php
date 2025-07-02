<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AcrtfmMailer extends Mailable
{
    use Queueable, SerializesModels;

    public array $content;
    /**
     * Create a new message instance.
     */
    public function __construct(array $content) {
        $this->content = $content;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            
            subject: $this->content['subject'],
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        if ($this->content['type'] == "fp") {
            return new Content(
                view: 'mailer.forgot_password',
                with: [
                    'link' => $this->content['body'],
                    'name' => $this->content['name']
                ]
            );
        } else if ($this->content['type'] == "pn") {
            return new Content(
                view: 'mailer.post_notification',
                with: [
                    'link' => $this->content['link']
                ]
            );
        }
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}