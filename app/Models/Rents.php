<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rents extends Model
{
    use HasFactory;

    protected $table = 'rents';

    protected $fillable = [
        'rent_name',
        'status',
        
    ];
}