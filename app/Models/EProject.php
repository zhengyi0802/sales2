<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EProject extends Model
{
    use HasFactory;

    protected $connection = 'sales';

    protected $table = 'd_projects';

    protected $fillable = [
        'serial',
        'has_gifts',
        'name',
        'price',
        'prepaid',
        'status',
        'memo',
    ];

}
