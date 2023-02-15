<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntegratorRequestHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'data',
        'method',
        'path',
        'integrator_id'
    ];
}
