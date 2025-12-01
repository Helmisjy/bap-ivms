<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Projects extends Model
{

    use SoftDeletes;

    protected $fillable = [
        'name',
        'project_code',
        'client_id'
    ];

    public function client()
    {
        return $this->belongsTo(Clients::class);
    }
}
