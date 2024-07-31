<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transactions extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'notes',
        'user_id',
        'numerah_id',
        'customer_id',
    ];

    public function numeraha(): HasMany
    {
        return $this->hasMany(numeraha::class);
    }
    public function customer(): BelongsTo
    {
        return $this->belongsTo(customers::class);
    }
}
