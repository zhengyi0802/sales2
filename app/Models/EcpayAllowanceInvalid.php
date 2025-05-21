<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EcpayAllowanceInvalid extends Model
{
    use HasFactory;

    protected $connection = 'sales';


    protected $fillable = [
        'AI_Allow_Date',
        'AI_Allow_No',
        'AI_Buyer_Identifier',
        'AI_Date',
        'AI_Invoice_No',
        'AI_Mer_ID',
        'Reason',
        'AI_Seller_Identifier',
        'AI_Upload_Date',
        'AI_Upload_Status',
        'RtnCode',
        'RtnMsg',
        'log_id',
    ];

    public function log()
    {
        return $this->belongsTo(EcpayApiLog::class, 'log_id');
    }
}
