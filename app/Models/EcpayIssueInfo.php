<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EcpayIssueInfo extends Model
{
    use HasFactory;

    protected $connection = 'sales';

    protected $fillable = [
        'invoice_no',
        'invoice_date',
        'ecpay_return',
        'rtn_code',
        'rtn_msg',
        'log_id',
    ];

    public function details()
    {
        return json_decode($this->ecpay_return);
    }
}
