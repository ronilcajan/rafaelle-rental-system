<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;

    protected $table = 'sales';

    protected $fillable = [
        'status',
        'payment_method',
        'amount',
        'transaction_date',
        'notes',
        'property_id',
        'tenant_id',
        'rent_payment_id'
    ];
}