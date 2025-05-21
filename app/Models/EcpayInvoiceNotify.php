<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EcpayInvoiceNotify extends Model
{
    use HasFactory;

    protected $connection = 'sales';

    protected $fillable = [
        'invoice_no',
        'allowance_no',
        'phone',
        'email',
        'notify',
        'tag',
        'notified',
        'log_id',
    ];

}
