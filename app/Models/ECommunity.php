<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ECommunity extends Model
{
    use HasFactory;

    protected $connection = 'sales';

    protected $table = 'communities';

    protected $fillable = [
        'city',
        'zone',
        'community',
        'address',
        'zipcode',
   ];

}
