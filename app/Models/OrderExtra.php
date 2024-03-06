<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderExtra extends Model
{
    use HasFactory;

    protected $connection = 'sales2';

    protected $fillable = [
        'order_id',
        'product_id',
        'price',
        'flow',
        'memo',
        'status',
        'order_date',
        'shipping_time',
        'created_by',
    ];

    function creator() {
        return $this->belongsTo(User::class, 'created_by');
    }

    function product() {
        return $this->belongsTo(ProductModel::class, 'product_id');
    }

}
