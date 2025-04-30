<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EApply extends Model
{
    use HasFactory;

    protected $connection = 'sales';

    protected $table = 'applies';

    protected $fillable = [
        'trade_no',
        'trade_date',
        'cname',
        'community_id',
        'persion',
        'amount',
        'name',
        'line_id',
        'unified_number',
        'phone',
        'email',
        'address',
        'placement',
        'project_id',
        'bundles',
        'gifts',
        'payment',
        'total',
        'prepay_total',
        'paid',
        'remain',
        'flow',
        'flow1',
        'gflows',
        'memo',
        'status',
        'reseller_id',
    ];

    public function project() {
        return $this->belongsTo(EProject::class, 'project_id');
    }

    public function community() {
        return $this->belongsTo(ECommunity::class, 'community_id');
    }

    public function reseller() {
        return $this->belongsTo(Sales::class, 'reseller_id');
    }

    public function processes() {
        return $this->hasMany(Process::class, 'apply_id');
    }

    public function ecpayResult() {
        return $this->hasOne(EcpayResult::class, 'apply_id');
    }

    public function ecpayInfo() {
        return $this->hasOne(EcpayInfo::class, 'apply_id');
    }
}
