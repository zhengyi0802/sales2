<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EcpayDelayIssueNotify extends Model
{
    use HasFactory;

    protected $connection = 'sales';

    protected $fillable = [
        'inv_mer_id',
        'od_sob',
        'tsr',
        'invoicedate',
        'invoicetime',
        'invoicenumber',
        'invoicecode',
        'inv_error',
    ];

}
