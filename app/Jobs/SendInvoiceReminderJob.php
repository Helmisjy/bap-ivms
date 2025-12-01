<?php

namespace App\Jobs;

use App\Mail\InvoiceCriticalMail;
use App\Mail\InvoiceEarlyMail;
use App\Mail\InvoiceOverdueMail;
use App\Mail\InvoiceWarningMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendInvoiceReminderJob implements ShouldQueue
{
    use Queueable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    // public function handle(): void
    // {
        
    // }

    public function handle()
    {
        $invoices = Invoice::with('client')->get();

        foreach ($invoices as $invoice) {

            if (!$invoice->client || !$invoice->client->email) {
                continue; // skip kalau client tidak punya email
            }

            $email = $invoice->client->email;

            // pastikan aging terbaru
            $invoice->calculateAging();
            $invoice->save();

            // mapping pengiriman sesuai kategori
            switch ($invoice->aging_status) {

                case 'early':
                    Mail::to($email)->send(new InvoiceEarlyMail($invoice));
                    break;

                case 'warning':
                    Mail::to($email)->send(new InvoiceWarningMail($invoice));
                    break;

                case 'overdue':
                    Mail::to($email)->send(new InvoiceOverdueMail($invoice));
                    break;

                case 'critical':
                    Mail::to($email)->send(new InvoiceCriticalMail($invoice));
                    break;

                default:
                    break;
            }
        }
    }
}
