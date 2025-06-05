<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EcpayAllowanceData extends Model
{
    use HasFactory;

    protected $connection = 'sales';


    protected $fillable = [
        'issue_id',
        'ecpay_return',
        'notify_method',
        'notify_mail',
        'notify_phone',
        'allowance_amount',
        'allowance_no',
        'invoice_no',
        'date',
        'temp_date',
        'temp_expire_date',
        'remain_allowance_amount',
        'router',
        'rtn_code',
        'rtn_msg',
        'invalid_flag',
        'invalid_date',
        'log_id',
    ];

    public function issue()
    {
        return $this->belongsTo(EcpayIssueData::class, 'issue_id');
    }

    public function log()
    {
        return $this->belongsTo(EcpayApiLog::class, 'log_id');
    }
}
