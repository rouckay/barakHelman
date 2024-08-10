<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customers extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'father_name',
        'grand_father_name',
        'province',
        'village',
        'tazkira',
        'mobile_number',
        'parmanent_address',
        'current_address',
        'numeraha_id',
        'payed_price',
        // 'due_price',
        'total_price',
        'job',
    ];

    public function numeraha(): BelongsTo
    {
        return $this->BelongsTo(numeraha::class, 'numeraha_id'); // Customer has many Numerahas
    }

}
