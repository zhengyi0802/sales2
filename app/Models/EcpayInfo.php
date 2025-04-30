<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EcpayInfo extends Model
{
    use HasFactory;

    protected $connection = 'sales';

    protected $fillable = [
        'trade_no',
        'trade_date',
        'ecpay_trade_no',
        'payment_type',
        'bank_code',
        'vaccount',
        'payment_no',
        'barcode1',
        'barcode2',
        'barcode3',
        'payment_total',
        'expire_date',
        'rtn_code',
        'rtn_msg',
        'apply_id',
        'paid',
        'payment_date',
    ];

    public function apply()
    {
        return $this->belongsTo(EApply::class, 'apply_id');
    }

}
