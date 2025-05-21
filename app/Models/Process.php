<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Process extends Model
{
    use HasFactory;

    protected $connection = 'sales';

    protected $fillable = [
        'case_name',
        'prom_id',
        'apply_id',
        'amount_id',
        'name',
        'phone',
        'address',
        'project',
        'flow',
        'status',
        'memo',
        'create_date',
        'photo_date',
        'shipping_date',
        'booking_date',
        'finish_date',
    ];

    public function eapply()
    {
        return $this->belongsTo(EApply::class, 'apply_id');
    }

}
