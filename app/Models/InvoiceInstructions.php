<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvoiceInstructions extends Model
{

    use HasFactory, SoftDeletes;

    protected $fillable = [
        'trx_code',
        'sale_order',
        'client_id',
        'project_id',
        'status',
        'po_number',
        'equipment_id',
        'start_date',
        'end_date',
        'remarks',
    ];

    public function client()
    {
        return $this->belongsTo(Clients::class);
    }

    public function project()
    {
        return $this->belongsTo(Projects::class);
    }

    public function equipment()
    {
        return $this->belongsTo(Equipments::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // generate unique trx_code before create
            $model->trx_code = $model->generateTrxCode();
        });
    }

    public function generateTrxCode()
    {
        // recommended incremental using latest id to avoid collisions
        $next = (self::max('id') ?? 0) + 1;
        return 'INV_' . str_pad($next, 5, '0', STR_PAD_LEFT);
    }


}
