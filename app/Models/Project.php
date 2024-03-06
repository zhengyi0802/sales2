<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $connection = 'sales2';

    protected $fillable = [
        'name',
        'details',
        'extras',
        'pictures',
        'salesing',
        'status',
        'created_by',
    ];

    function creator() {
        return $this->belongsTo(User::class, 'created_by');
    }

    function gifts() {
        if ($this->extras == null) {
            return null;
        }
        $arr = json_decode($this->extras);
        $products = ProductModel::whereIn('id', $arr)->get();
        return $products;
    }
}
