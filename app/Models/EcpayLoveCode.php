<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EcpayLoveCode extends Model
{
    use HasFactory;

    protected $connection = 'sales';

    protected $fillable = [
        'love_code',
        'organ_name',
        'is_exist',
        'log_id',
    ];

    public function log()
    {
        return $this->belongsTo(EcpayApiLog::class, 'log_id');
    }

}
