<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GasExport extends Model
{
    use HasFactory;

    protected $connection = 'sales';

    protected $fillable = [
        'ids',
        'apply_id',
        'prom_id',
        'proj_id',
        'path',
        'ecount',
        'created_by',
    ];

    public function eapply()
    {
        return $this->belongsTo(EApply::class, 'apply_id');
    }

    public function promotion()
    {
        return $this->belongsTo(HpPromotion::class, 'prom_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

}
