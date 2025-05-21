<?php

namespace App\Collections;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssueCollection extends Model
{
    use HasFactory;

    protected $connection = 'sales';

    protected $fillable = [
        'MerchantID',
        'RelateNumber',
        'ChannelPartner',
        'CustomerID',
        'ProductServiceID',
        'CustomerIdentifier',
        'CustomerName',
        'CustomerAddr',
        'CustomerPhone',
        'CustomerEmail',
        'ClearanceMark',
        'Print',
        'Donation',
        'LoveCode',
        'CarrierType',
        'CarrierNum',
        'CarrierNum2',
        'TaxType',
        'ZeroTaxRateReason',
        'SpecialTaxType',
        'SalesAmount',
        'InvoiceRemark',
        'InvType',
        'DelayFlag',
        'DelayDay',
        'Tsr',
        'PayType',
        'PayAct',
        'NotifyURL',
        'InvTypr',
        'vat',
        'Items',
        'Router',
        'log_id',
        'apply_id',
        'prom_id',
    ];

    public function __construct()
    {
        $this->Print = '1';
        $this->Donation = '0';
        $this->TaxType = '1';
        $this->InvType = '07';
        $this->vat = '1';
    }

}
