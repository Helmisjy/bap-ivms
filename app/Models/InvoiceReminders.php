<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceReminders extends Model
{
    use HasFactory;

    protected $table = 'invoice_reminders';

    protected $fillable = [
        'invoice_tracking_id',
        'category',
        'sent_to',
        'days',
        'invoice_id',
        'reminder_type',
        'reminder_date',
        'status',
        'sent_at',
        'notes',
    ];

    protected $casts = [
        'reminder_date' => 'datetime',
        'sent_at' => 'datetime',
    ];


    /**
     * Relations
     */

    // invoice_reminders.invoice_id → invoice_trackings.id
    public function invoice()
    {
        return $this->belongsTo(InvoiceTracking::class, 'invoice_id');
    }


    /**
     * Query Scopes
     */

    // Reminder yang belum dikirim & sudah due untuk dikirim
    public function scopeDue($query)
    {
        return $query->where('status', 'scheduled')
                     ->where('reminder_date', '<=', now());
    }


    /**
     * Helper
     */

    public function isSent()
    {
        return $this->status === 'sent';
    }

    public function isFailed()
    {
        return $this->status === 'failed';
    }

    public function markAsSent()
    {
        $this->update([
            'status' => 'sent',
            'sent_at' => now(),
        ]);
    }

    public function markAsFailed()
    {
        $this->update([
            'status' => 'failed',
        ]);
    }
}
