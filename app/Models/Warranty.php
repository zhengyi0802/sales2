<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warranty extends Model
{
    use HasFactory;

    protected $connection = 'sales2';

    protected $fillable = [
        'phone',
        'order_id',
        'product_id',
        'register_time',
        'warranty_date',
    ];

    public function order() {
        return $this->belongsTo(Order::class, 'order_id');;
    }

    public function product() {
        return $this->belongsTo(ProductModel::class, 'product_id');
    }

}
