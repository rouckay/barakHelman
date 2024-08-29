<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
        'Customer_image',
        'job',
        'responsable_name',
        'responsable_father_name',
        'responsable_grand_father_name',
        'responsable_province',
        'responsable_village',
        'responsable_tazkira',
        'responsable_mobile_number',
        'responsable_image',
        'responsable_job',
    ];

    public function numerahas(): BelongsToMany
    {
        return $this->belongsToMany(Numeraha::class, 'customer_numerahas', 'customer_id', 'numeraha_id');
    }

}
