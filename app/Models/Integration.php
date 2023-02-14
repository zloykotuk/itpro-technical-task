<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Integration extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'host',
        'token',
        'token_expires_in',
        'username',
        'password',
    ];
}
