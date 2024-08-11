<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CustomerNumeraha extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'numeraha_id',
        'documents',
        'remarks',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customers::class);
    }

    public function numeraha(): BelongsTo
    {
        return $this->belongsTo(Numeraha::class);
    }

}
