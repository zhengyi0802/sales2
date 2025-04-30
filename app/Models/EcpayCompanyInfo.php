<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EcpayCompanyInfo extends Model
{
    use HasFactory;

    protected $connection = 'sales';

    protected $fillable = [
        'unified_number',
        'company_name',
        'log_id',
    ];

    public function log()
    {
        return $this->belongsTo(EcpayApiLog::class, 'log_id');
    }
}
