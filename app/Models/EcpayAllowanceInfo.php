<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EcpayAllowanceInfo extends Model
{
    use HasFactory;

    protected $connection = 'sales';


    protected $fillable = [
        'allowance_id',
        'ecpay_return',
        'router',
        'rtn_code',
        'rtn_msg',
        'log_id',
    ];

    public function allowanceData()
    {
        return $this->belongsTo(EcpayAllowanceData::class, 'allowance_id');
    }

    public function log()
    {
        return $this->belongsTo(EcpayApiLog::class, 'log_id');
    }

    public function details()
    {
        return json_decode($this->ecpay_return);
    }
}
