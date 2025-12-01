<?php

namespace App\Mail;

use App\Models\InvoiceTracking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InvoiceReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

    public $invoice;
    public $category;

    public function __construct(InvoiceTracking $invoice, $category)
    {
        $this->invoice = $invoice;
        $this->category = $category;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Invoice Reminder Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.invoice-reminder',
        );
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

    public function build()
    {
        // return $this->subject("Invoice Reminder - {$this->invoice->inv_number}")
        //     ->view('emails.invoice-reminder');

        return $this->subject('Invoice Payment Reminder')
                ->view('emails.invoice-reminder')
                ->with([
                    'invoice' => $this->invoice,
                    'category' => $this->category,
                ]);
    }
}
