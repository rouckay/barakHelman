<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

use \LaravelArchivable\Archivable;
class Numeraha extends Model
{
    // protected $primaryKey = 'numerahaID';
    use HasFactory;
    use Archivable;
    protected $fillable = [
        'numera_id',
        'Land_Area',
        'date',
        // 'tarifa_no',
        // 'numera_price',
        'sharwali_tarifa_price',
        'documents',
        'north',
        'south',
        'east',
        'west',
        'description',
        // 'customer_id',
        'numera_type'
    ];
    protected $casts = [
        'documents' => 'array',
    ];
    public function Customers(): BelongsToMany
    {
        return $this->belongsToMany(Customers::class, 'customer_numerahas', 'numeraha_id', 'customer_id'); // Numeraha belongs to a Customer
    }
    // In App\Models\Numeraha
    // public function numeraha(): BelongsTo
    // {
    //     return $this->belongsTo(CustomerNumeraha::class);
    // }

}
