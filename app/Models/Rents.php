<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'deposit',
        'amount',
        'rent',
        'status',
        'notes',
        'property_id',
        'tenants_id',
    ];


    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenants::class,'tenants_id');
    }

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(RentPayments::class,'rent_id');
    }
    
} 