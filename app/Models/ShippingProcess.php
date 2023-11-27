<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingProcess extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'serialno',
        'shipping_date',
        'completion_time',
        'chargeback_time',
        'installer_id',
        'created_by',
    ];

    function creator() {
        return $this->belongsTo(User::class, 'created_by');
    }

    function order() {
        return $this->belongsTo(Order::class, 'order_id');
    }

}
