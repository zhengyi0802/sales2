<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EOrderExtra extends Model
{
    use HasFactory;

    protected $connection = 'sales';

    protected $table = 'order_extras';

    protected $fillable = [
        'order_id',
        'product_id',
        'price',
        'flow',
        'memo',
        'status',
        'order_date',
        'shipping_time',
    ];

    function product() {
        return $this->belongsTo(ProductModel::class, 'product_id');
    }

}
