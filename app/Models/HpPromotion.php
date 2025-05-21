<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HpPromotion extends Model
{
    use HasFactory;

    protected $connection = 'sales';

    protected $fillable = [
        'trade_no',
        'trade_date',
        'name',
        'line_id',
        'unified_number',
        'phone',
        'email',
        'address',
        'payment',
        'paytype_id',
        'amount',
        'total',
        'shipping_price',
        'shipping_paid',
        'prepay_total',
        'paid',
        'remain',
        'product_id',
        'proj_id',
        'bundles',
        'gifts',
        'memo',
        'flow',
        'flow1',
        'gflows',
        'status',
        'reseller_id',
    ];

    public function Paytype()
    {
        return $this->belongsTo(Paytype::class, 'paytype_id');
    }

    public function product()
    {
        return $this->belongsTo(HpProduct::class, 'product_id');
    }

    public function reseller()
    {
        return $this->belongsTo(Sales::class, 'reseller_id');
    }

    public function ecpayResult()
    {
        return $this->hasOne(EcpayResult::class, 'prom_id');
    }

    public function ecpayInfo()
    {
        return $this->hasOne(EcpayInfo::class, 'prom_id');
    }
}
