<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Process extends Model
{
    use HasFactory;

    protected $connection = 'sales';

    protected $fillable = [
        'apply_id',
        'amount_id',
        'name',
        'phone',
        'address',
        'project',
        'flow',
        'status',
        'memo',
    ];

    public function eapply()
    {
        return $this->belongsTo(EApply::class, 'apply_id');
    }

}
