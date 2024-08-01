<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Numeraha extends Model
{
    // protected $primaryKey = 'numerahaID';
    use HasFactory;
    protected $fillable = [
        'numero_number',
        'save_number',
        'date',
        'tarifa_no',
        'transfered_money_to_bank',
        'Customer_image',
        'documents',
        // 'customers_id',
    ];

    public function Customers(): HasMany
    {
        return $this->hasMany(Customers::class, 'numerahas_id'); // Numeraha belongs to a Customer
    }
}
