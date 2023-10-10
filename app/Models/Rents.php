<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rents extends Model
{
    use HasFactory;

    protected $table = 'rents';

    protected $fillable = [
        'start_date',
        'end_date',
        'terms',
        'rent_type',
        'payment_method',
        'penalty',
        'discount',
        'amount',
        'status',
        'notes',
        'property_id',
        'tenant_id',
    ];
}