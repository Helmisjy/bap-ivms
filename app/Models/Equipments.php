<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipments extends Model
{
    protected $fillable = [
        'name',
        'eq_number',
        'eq_code',
        'eq_capacity',
        'status',
    ];
}
