<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ECustomer extends Model
{
    use HasFactory;

    protected $connection = 'sales';

    protected $table = 'customers';

    protected $fillable = [
        'name',
        'phone',
        'line_id',
        'email',
        'pid',
        'address',
        'status',
        'sales_id',
        'order_date',
        'status',
    ];

    function sales() {
        return $this->belongsTo(Sales::class, 'sales_id');
    }

    function order() {
        return $this->hasOne(EOrder::class, 'customer_id');
    }
}
