<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $connection = 'major';

    protected $fillable = [
       'type_id',
       'serialno',
       'android_id',
       'ether_mac',
       'wifi_mac',
       'proj_id',
       'expire_date',
       'query_string',
       'status_id',
    ];

}
