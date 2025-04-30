<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EcpayApiLog extends Model
{
    use HasFactory;

    protected $connection = 'sales';

    protected $fillable = [
        'name',
        'trans_code',
        'trans_msg',
        'rtn_code',
        'rtn_msg',
    ];

}
