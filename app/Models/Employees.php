<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'lastName',
        'FatherName',
        'Position',
        'Education',
        'salary',
        'tazkira',
        'date_of_contract',
        'end_date_of_contract',
        'phone_number',
        'Address',
    ];

}
