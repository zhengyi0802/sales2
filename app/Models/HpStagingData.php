<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HpStagingData extends Model
{
    use HasFactory;

    protected $connection = 'sales';

    protected $fillable = [
        'apply_id',
        'prom_id',
        'trade_date',
        'staging_serial',
        'trade_from',
    ];

    public function eapply()
    {
        return $this->belongsTo(EApply::class, 'apply_id');
    }
    public function promotion2()
    {
        return $this->belongsTo(HpPromotion::class, 'prom_id');
    }

}
