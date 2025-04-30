<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EBundle extends Model
{
    use HasFactory;

    protected $connection = 'sales';

    protected $fillable = [
        'name',
        'price',
    ];

}
