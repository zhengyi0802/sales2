<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;

    protected $connection = 'sales2';

    protected $fillable = [
        'name',
        'phone',
        'lin_id',
        'email',
        'company',
        'job',
        'address',
        'status',
        'user_id',
        'upper_id',
        'created_by',
    ];

    function creator() {
        return $this->belongsTo(User::class, 'created_by');
    }

    function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    function upper() {
        return $this->belongsTo(User::class, 'upper_id');
    }

}
