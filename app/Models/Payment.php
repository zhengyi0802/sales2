<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'amount',
        'rest_amount',
        'payment_method',
        'status',
        'created_by',
    ];

    function creator() {
        return $this->belongsTo(User::class, 'created_by');
    }

    function order() {
        return $this->belongsTo(Order::class, 'order_id');
    }

}
