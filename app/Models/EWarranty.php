<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EWarranty extends Model
{
    use HasFactory;

    protected $connection = 'major';

    protected $fillable = [
        'phone',
        'product_id',
        'register_time',
    ];

    public function order() {
        $order = Order::where('phone', $this->phone)->first();
        return $order;
    }

    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function productModel()
    {
        return $this->order()->product;
    }
}
