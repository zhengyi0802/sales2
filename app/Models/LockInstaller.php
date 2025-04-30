<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LockInstaller extends Model
{
    use HasFactory;

    protected $connection = 'sales';

    protected $fillable = [
        'name',
        'phone',
        'line_id',
        'email',
        'address',
        'unified_number',
        'project_id',
        'amount',
        'price',
        'total',
        'paid',
        'remain',
        'flow',
        'flow1',
        'status',
        'memo',
        'reseller_id',
    ];

    public function reseller()
    {
        return $this->belongsTo(Reseller::class, 'reseller_id');
    }

    public function project()
    {
        return $this->belongsTo(DProject::class, 'project_id');
    }
}
