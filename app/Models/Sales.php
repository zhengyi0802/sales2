<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'company',
        'job',
        'status',
        'user_id',
        'created_by',
    ];

    function creator() {
        return $this->belongsTo(User::class, 'created_by');
    }

    function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
