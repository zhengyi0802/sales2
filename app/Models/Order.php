<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'customer_id',
        'product_id',
        'project_id',
        'sales_id',
        'name',
        'phone',
        'address',
        'price',
        'flow',
        'memo',
        'status',
        'order_date',
        'created_by',
    ];

    function creator() {
        return $this->belongsTo(User::class, 'created_by');
    }

    function customer() {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    function product() {
        return $this->belongsTo(ProductModel::class, 'product_id');
    }

    function project() {
        return $this->belongsTo(Project::class, 'project_id');
    }

    function sales() {
        return $this->belongsTo(Sales::class, 'sales_id');
    }

    function extras() {
        return $this->hasMany(OrderExtra::class, 'order_id');
    }

    function shipping() {
        return $this->hasOne(ShippingProcess::class, 'order_id');
    }
}
