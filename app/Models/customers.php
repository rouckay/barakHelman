<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class customers extends Model
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
        'job',
    ];

    public function numeraha(): BelongsTo
    {
        return $this->belongsTo(numeraha::class);
    }

}
