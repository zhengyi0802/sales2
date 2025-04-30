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
        'notify_method',
        'notify_mail',
        'notify_phone',
        'allowance_amount',
        'allow_no',
        'invoice_no',
        'date',
        'temp_date',
        'temp_expire_date',
        'remain_allowance_amount',
        'rtn_code',
        'rtn_msg',
        'log_id',
    ];

    public function issue()
    {
        return $this->belongsTo(EcpayIssue::class, 'issue_id');
    }

    public function log()
    {
        return $this->belongsTo(EcpayApiLog::class, 'log_id');
    }
}
