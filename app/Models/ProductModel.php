<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'catagory_id',
        'vendor_id',
        'briefs',
        'spectficaions',
        'descriptions',
        'created_by',
    ];

    function creator() {
        return $this->belongsTo(User::class, 'created_by');
    }

    functioon catagory() {
        return $this->belongsTo(Catagory::class, 'catagory_id');
    }

    function vendor() {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }

}
