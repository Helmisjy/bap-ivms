<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\InvoiceReminderMail;
use App\Models\InvoiceTracking;
use App\Models\InvoiceReminders;
use Illuminate\Support\Facades\Mail;

class SendInvoiceReminders extends Command
{

    // protected $signature = 'invoices:send-reminders';
    // protected $description = 'Send automatic invoice reminders based on aging';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // protected $signature = 'app:send-invoice-reminders';
    protected $signature = 'invoices:send-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    // protected $description = 'Command description';
    protected $description = 'Send automatic invoice reminders based on aging';
    /**
     * Execute the console command.
     */

    public function handle()
    {
        
        $this->info("Running invoice reminders...");

        $invoices = InvoiceTracking::with('client')->whereNotNull('inv_target')->get();

        // foreach ($invoices as $invoice) {

        //     $category = $this->getCategory($invoice->aging_days);

        //     if (!$category || !$invoice->client?->email) {
        //         continue;
        //     }

        //     // Cek apakah kategori sudah pernah dikirim sebelumnya
        //     $alreadySent = InvoiceReminders::where('invoice_tracking_id', $invoice->id)
        //         ->where('category', $category)
        //         ->exists();

        //     if ($alreadySent) {
        //         continue;
        //     }

        //     // Kirim email
        //     Mail::to($invoice->client->email)
        //         ->send(new InvoiceReminderMail($invoice, $category));

        //     // Simpan log reminder
        //     InvoiceReminders::create([
        //         'invoice_tracking_id' => $invoice->id,
        //         'category' => $category,
        //         'sent_to' => $invoice->client->email,
        //         'days' => $invoice->aging_days
        //     ]);

        //     $this->info("Email sent → {$invoice->client->email} [{$category}]");
        // }

        foreach ($invoices as $invoice) {

            // Hitung aging
            $days = now()->diffInDays($invoice->inv_target, false);

            // Tentukan kategori reminder
            $category = $this->getCategory($days);

            if (!$category) {
                continue;
            }

            // Jika client tidak ada → skip
            if (!$invoice->clients || !$invoice->clients->email) {
                $this->warn("Invoice {$invoice->id} tidak memiliki client/email. Dilewati.");
                continue;
            }

            // Cegah kirim ulang pada hari yang sama
            $alreadySent = InvoiceReminders::where('invoice_id', $invoice->id)
                ->whereDate('reminder_date', now()->toDateString())
                ->exists();

            if ($alreadySent) {
                continue;
            }

            // 🔥🔥🔥 KIRIM EMAIL
            Mail::to($invoice->clients->email)
                ->send(new InvoiceReminderMail($invoice, $category));

            // Simpan log pengiriman
            InvoiceReminders::create([
                'invoice_id' => $invoice->id,
                'reminder_type' => 'email',
                'reminder_date' => now(),
                'status' => 'sent',
                'notes' => "Auto reminder ($category)",
            ]);
        }

        return Command::SUCCESS;
    }

    private function getCategory($days)
    {
        return match (true) {
            $days >= -59 && $days <= -51 => 'category_1',
            $days >= -50 && $days <= -31 => 'category_2',
            $days >= -30 && $days <= -16 => 'category_3',
            $days >= -15 && $days <= 0   => 'category_4',

            $days > 0 && $days <= 29     => 'category_5',
            $days >= 30 && $days <= 59   => 'category_6',
            $days >= 60 && $days <= 89   => 'category_7',
            $days >= 90                  => 'category_8',

            default => null,
        };
    }
}
