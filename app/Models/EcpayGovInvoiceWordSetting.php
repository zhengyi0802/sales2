<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EcpayGovInvoiceWordSetting extends Model
{
    use HasFactory;

    protected $connection = 'sales';

    protected $fillable = [
        'year',
        'term',
        'type',
        'header',
        'start',
        'end',
        'number',
        'status',
    ];

}
