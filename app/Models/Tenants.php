<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Tenants extends Model
{
    use HasFactory;

    protected $table = 'tenants';

    protected $fillable = [
        'name',
        'contact_no',
        'email',
        'address',
        'image'
    ];

    public function rents(): HasMany
    {
        return $this->hasMany(Rents::class);
    }
} 