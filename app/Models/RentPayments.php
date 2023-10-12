<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RentPayments extends Model
{
    use HasFactory;

    protected $table = 'rent_payments';

    protected $fillable = [
        'rent_id',
        'amount',
        'status',
        'due_date',
        'date_paid',
    ];

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Rents::class);
    }
}