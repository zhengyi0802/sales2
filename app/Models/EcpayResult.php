<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EcpayResult extends Model
{
    use HasFactory;

    protected $connection = 'sales';

    protected $fillable = [
        'trade_no',
        'trade_date',
        'trade_amount',
        'ecpay_trade_no',
        'payment_date',
        'payment_type',
        'charge_fee',
        'rtn_code',
        'rtn_msg',
        'simulate_paid',
        'apply_id',
        'prom_id',
        'path',
    ];

    public function apply() {
        return $this->belongsTo(EApply::class, 'apply_id');
    }

    public function promotion() {
        return $this->belongsTo(HpPromotion::class, 'prom_id');
    }

}
