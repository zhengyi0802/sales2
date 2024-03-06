<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $connection = 'sales2';

    protected $fillable = [
        'name',
        'phone',
        'line_id',
        'email',
        'pid',
        'address',
        'status',
        'sales_id',
        'created_by',
    ];

    function creator() {
        return $this->belongsTo(User::class, 'created_by');
    }

    function sales() {
        return $this->belongsTo(Sales::class, 'sales_id');
    }

    function orders() {
        return $this->hasMany(Order::class, 'customer_id');
    }
}
