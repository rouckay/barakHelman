<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CustomerNumeraha extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'numeraha_id',
        'multipleDocs',
        'first_phase',
        'second_phase',
        'third_phase',
        'fourth_phase',
        'fifth_phase',
        'sixth_phase',
        'payed_price',
        'total_price',
        'remarks',
    ];

    // Custom code For converting MultipleDocs to Json when Saving
    protected $casts = [
        'multipleDocs' => 'array',
    ];
    // protected static function boot()
    // {
    //     parent::boot();

    //     static::saving(function ($model) {

    //         if (is_array($model->multipleDocs)) {
    //             $model->multipleDocs = json_encode($model->multipleDocs);
    //         }
    //     });
    // }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customers::class);
    }

    public function numeraha(): BelongsTo
    {
        return $this->belongsTo(Numeraha::class);
    }


}
