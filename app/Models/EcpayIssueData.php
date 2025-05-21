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
        'prom_id',
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
        'order_number',
        'rtn_code',
        'rtn_msg',
        'log_id',
        'invalid_flag',
    ];

    public function details()
    {
        return json_decode($this->issue_data);
    }

    public function apply()
    {
        return $this->belongsTo(EApply::class, 'apply_id');
    }

    public function promotion()
    {
        return $this->belongsTo(HpPromotion::class, 'prom_id');
    }

    public function log()
    {
        return $this->belongsTo(EcpayApiLog::class, 'log_id');
    }
}
