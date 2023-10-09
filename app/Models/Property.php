<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Property extends Model
{
    use HasFactory;

    protected $table = 'properties';

    protected $fillable = [
        'property_name',
        'location',
        'price',
        'monthly',
        'yearly',
        'status',
        'image',
        'owner_id'
    ];


    public function owner(): BelongsTo
    {
        return $this->belongsTo(Owner::class);
    }
}