<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentPayments extends Model
{
    use HasFactory;

    protected $table = 'rent_payments';

    protected $fillable = [
        'rent_id',
        'amount',
        'status',
        'due_date',
    ];
}