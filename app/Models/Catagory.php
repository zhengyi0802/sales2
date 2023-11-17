<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catagory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'created_by',
    ];

    function creator() {
        return $this->belongsTo(User::class, 'created_by');
    }
}
