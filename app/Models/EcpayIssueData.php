<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EcpayIssueData extends Model
{
    use HasFactory;

    protected $connection = 'sales';


    protected $fillable = [
        'apply_id',
        'issue_data',
        'invoice_no',
        'invoice_date',
        'random_number',
        'tsr',
        'delay_flag',
        'delay_day',
        'trigger_date',
        'invalid_date',
        'invalid_reason',
        'rtn_code',
        'rtn_msg',
        'log_id',
    ];

    public function apply()
    {
        return $this->belongsTo(EApply::class, 'apply_id');
    }

    public function log()
    {
        return $this->belongsTo(EcpayApiLog::class, 'log_id');
    }
}
