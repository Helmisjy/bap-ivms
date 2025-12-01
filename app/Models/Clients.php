<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class Clients extends Model
{
    protected $fillable = [
        'name',
        'client_code',
        'pic',
        'email'
    ];

    public function Projects()
    {
        return $this->hasMany(Projects::class);
    }
}
