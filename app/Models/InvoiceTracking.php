<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class InvoiceTracking extends Model
{
    protected $fillable = [
        'invoice_instruction_id',
        'client_id',
        'inv_number',
        'inv_instruction',
        'inv_target',
        'inv_date',
        'inv_delivery',
        'payment_due_date',
        'collection_date',
        'payment_date',
        'amount',
        'aging_days',
        'aging_status',
        'payment_status',
        'risk_level'
    ];

    public function instruction() 
    { 
        return $this->belongsTo(InvoiceInstructions::class, 'invoice_instruction_id'); 
    }

    public function histories() 
    { 
        // return $this->hasMany(InvoiceHistory::class, 'invoice_id'); 
    }

    protected static function boot()
    {
        parent::boot();

        // static::saving(function ($model) {
        //     $model->calculateAging();
        // });
        static::creating(function ($model) {
            if ($model->invoice_instruction_id) {
                $instruction = InvoiceInstructions::find($model->invoice_instruction_id);
                if ($instruction) {
                    $model->client_id = $instruction->client_id;
                }
            }
        });

        static::saving(function ($model) {
            $model->calculateAging();
        });
    }

    public function calculateAging()
    {
        if (!$this->inv_target) {
        $this->aging_days = 0;
        $this->aging_status = 'unknown';
        $this->risk_level = 'Low';
        return;
        }

        // pakai startOfDay untuk menghindari jam
        $today  = Carbon::now()->startOfDay();
        $target = Carbon::parse($this->inv_target)->startOfDay();

        // hitung selisih detik -> ubah jadi hari (positif = overdue, negatif = sebelum due date)
        $diffSeconds = $today->getTimestamp() - $target->getTimestamp();
        $days = (int) floor($diffSeconds / 86400); // 86400 detik = 1 hari

        // Jika hari ini > target -> $days > 0 (overdue)
        // Jika hari ini < target -> $days < 0 (belum due)
        $this->aging_days = $days;

        // tentukan status dan risk
        $this->aging_status = $this->calculateAgingStatus($days);
        $this->risk_level   = $this->calculateRisk($days);
    }


    public function calculateAgingStatus(int $days): string
    {
        // days negatif = sebelum due (before target)
        if ($days < -50) return '51–59 days before target';
        if ($days < -30) return '31–50 days before target';
        if ($days < -15) return '16–30 days before target';
        if ($days < 0)   return '0–15 days before target';

        // days >= 0 => already overdue
        if ($days <= 29) return '0–29 days overdue';
        if ($days <= 59) return '30–59 days overdue';
        if ($days <= 89) return '60–89 days overdue';
        return '90+ days overdue';
    }


    public function calculateRisk(int $days): string
    {
        if ($days < 0) return 'Low';            // belum jatuh tempo
        if ($days <= 30) return 'Medium';      // 1-30 days overdue
        if ($days <= 90) return 'High';        // 31-90 days overdue
        return 'Critical';                     // >90
    }

    public function getAgingDaysAttribute($value)
    {
        return (int) $value;
    }

    public function reminders()
    {
        return $this->hasMany(InvoiceReminders::class, 'invoice_id');
    }

    public function client()
    {
        return $this->belongsTo(Clients::class, 'client_id');
    }

    // public function client()
    // {
    //     return $this->instruction ? $this->instruction->client() : null;
    // }

    




}   
