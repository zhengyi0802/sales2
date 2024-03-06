<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $connection = 'sales2';

    protected $fillable = [
        'serial',
        'product_id',
        'start_amount',
        'inbound',
        'outbound',
        'defective',
        'stock',
        'status',
        'created_by',
    ];

    function creator() {
        return $this->belongsTo(User::class, 'created_by');
    }

    function product() {
        return $this->belongsTo(ProductModel::class, 'product_id');
    }

}
