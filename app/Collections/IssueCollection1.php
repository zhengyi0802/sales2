<?php

namespace App\Collections;

use Illuminate\Support\Collection;

class IssueCollection1 extends Collection {
    public $apply_id;
    public $prom_id;
    public $MerchantID;
    public $RelateNumber;
    public $CustomerID = '';
    public $CustomerIdentifier = '';
    public $CustomerName;
    public $CustomerAddr;
    public $CustomerPhone = '';
    public $CustomerEmail;
    public $ClearanceMark = '1';
    public $Print = '1';
    public $Donation = '0';
    public $LoveCode = '';
    public $CarrierType = '';
    public $CarrierNum = '';
    public $CarrierNum2;
    public $ZeroTaxRateReason;
    public $SpecialTaxType;
    public $TaxType = '1';
    public $SalesAmount;
    public $InvoiceRemark = '發票備註';
    public $InvType = '07';
    public $DelayFlag;
    public $DelayDay;
    public $vat = '1';
    public $Tsr;
    public $PayType = '2';
    public $PayAct = 'ECPAY';
    public $NotifyURL;
    public $Items;

    public function __construct() {

    }

}

