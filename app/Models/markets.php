<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class markets extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'lengthm_m2',
        'nomerah_number',
        'nomerah_owner',
        'owner_phone_number',
    ];
}
