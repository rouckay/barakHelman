<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class numeraha extends Model
{
    use HasFactory;
    protected $fillable = [
        'numero_number',
        'save_number',
        'date',
        'tarifa_no',
        'transfered_money_to_bank',
        'Customer_image',
        'documents',
        'customer_id',
    ];

    public function customers()
    {
        return $this->hasMany(Customers::class); // Ensure proper class name casing
    }
}
