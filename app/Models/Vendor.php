<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $connection = 'sales2';

    protected $fillable = [
        'name',
        'company',
        'country',
        'memo',
        'status',
        'created_by',
    ];

    function creator() {
        return $this->belongsTo(User::class, 'created_by');
    }

    function products() {
        return $this->hasMany(ProductModel::class, 'vendor_id');
    }
}
