<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EcpayAllowanceNotify extends Model
{
    use HasFactory;

    protected $connection = 'sales';

    protected $fillable = [
        'RtnCode',
        'RtnMsg',
        'IA_Allow_No',
        'IA_Invoice_No',
        'IA_Date',
        'IIS_Remain_Allowance_Amt',
        'CheckMacValue',
    ];

}
