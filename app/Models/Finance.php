<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Finance extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'quantity',
        'unit',
        // 'total_price',
        'dollor',
        'dollor_unit',
        // 'dollor_total',
        'phone_number',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->BelongsTo(User::class);
    }
}
