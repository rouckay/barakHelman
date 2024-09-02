<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
    public function numerNumer(): BelongsTo
    {
        return $this->belongsTo(Numeraha::class);
    }
    public function nomerah_owner(): BelongsTo
    {
        return $this->belongsTo(Customers::class);
    }
}
