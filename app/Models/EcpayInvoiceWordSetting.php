<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EcpayInvoiceWordSetting extends Model
{
    use HasFactory;

    protected $connection = 'sales';

    protected $fillable = [
        'year',
        'term',
        'header',
        'start',
        'end',
        'track_id',
        'invoice_no',
        'status',
        'command',
        'log_id',
    ];

    public function log()
    {
        return $this->belongsTo(EcpayApiLog::class, 'log_id');
    }
}
