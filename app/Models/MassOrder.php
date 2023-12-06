<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MassOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'cname',
        'phone',
        'line_id',
        'email',
        'address',
        'cid',
        'invoice',
        'products',
        'price',
        'tax',
        'total',
        'memo',
        'mark',
        'flow',
        'order_date',
        'process_date',
        'outbound_date',
        'arrived_date',
        'status',
        'created_by',
    ];

    function creator() {
        return $this->belongsTo(User::class, 'created_by');
    }

}
