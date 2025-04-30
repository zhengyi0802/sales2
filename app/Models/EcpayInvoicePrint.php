<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EcpayInvoicePrint extends Model
{
    use HasFactory;

    protected $connection = 'sales';

    protected $fillable = [
        'invoice_no',
        'invoice_date',
        'invoice_html',
        'log_id',
    ];

}
