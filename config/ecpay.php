<?php

return [
    'test_InvoiceURL'             => env('ECPAY_TEST_INVOICE_BASIC_URL', ''),
    'test_MerchantId'             => env('ECPAY_TEST_INVOICE_MERCHANT_ID', ''),
    'test_HashKey'                => env('ECPAY_TEST_INVOICE_HASH_KEY', ''),
    'test_HashIV'                 => env('ECPAY_TEST_INVOICE_HASH_IV', ''),
    'InvoiceURL'                  => env('ECPAY_INVOICE_BASIC_URL', ''),
    'MerchantId'                  => env('ECPAY_INVOICE_MERCHANT_ID', ''),
    'HashKey'                     => env('ECPAY_INVOICE_HASH_KEY', ''),
    'HashIV'                      => env('ECPAY_INVOICE_HASH_IV', ''),
    'AllowancReturnURL'           => env('ECPAY_ALLOWANCE_RETURN_URL', ''),
    'GetGovInvoiceWordSetting'    => env('ECPAY_GET_GOV_INVOICE_WORD_SETTING', ''),  //查詢財政部配號結果
    'AddInvoiceWordSetting'       => env('ECPAY_ADD_INVOICE_WORD_SETTING', ''),      //字軌與配號設定
    'UpdateInvoiceWordStatus'     => env('ECPAY_UPDATE_INVOICE_WORD_STATUS', ''),    //設定字軌號碼狀態
    'GetInvoiceWordSetting'       => env('ECPAY_GET_INVOICE_WORD_SETTING', ''),      //查詢字軌
    'GetCompanyNameByTaxID'       => env('ECPAY_GET_COMPANY_NAME_BY_TAX_ID', ''),    //統一編號驗證
    'CheckBarcode'                => env('ECPAY_CHECK_BARCODE', ''),                 //手機條碼驗證
    'CheckLoveCode'               => env('ECPAY_CHECK_LOVE_CODE', ''),               //捐贈碼驗證
    'Issue'                       => env('ECPAY_ISSUE', ''),                         //一般開立發票
    'DelayIssue'                  => env('ECPAY_DELAY_ISSUE', ''),                   //延遲開立發票（預約開立發票）
    'EditDelayIssue'              => env('ECPAY_EDIT_DELAY_ISSUE', ''),              //編輯延遲開立發票
    'TriggerIssue'                => env('ECPAY_TRIGGER_ISSUE', ''),                 //觸發開立發票
    'CancelDelayIssue'            => env('ECPAY_CANCEL_DELAY_ISSUE', ''),            //取消延遲開立發票
    'Invalid'                     => env('ECPAY_INVALID', ''),                       //作廢發票
    'GetIssue'                    => env('ECPAY_GET_ISSUE', ''),                     //查詢發票明細
    'GetInvalid'                  => env('ECPAY_GET_INVALID', ''),                   //查詢作廢發票明細
    'GetIssueList'                => env('ECPAY_GET_ISSUE_LIST', ''),                //查詢特定多筆發票
    'InvoiceNotify'               => env('ECPAY_INVOICE_NOTIFY', ''),                //發送發票通知
    'InvoicePrint'                => env('ECPAY_INVOICE_PRINT', ''),                 //發票列印
    'VoidWithReIssue'             => env('ECPAY_VOID_WITH_REISSUE', ''),             //註銷重開
    'Allowance'                   => env('ECPAY_ALLOWANCE', ''),                     //一般開立折讓（紙本開立）
    'AllowanceByCollegiate'       => env('ECPAY_ALLOWANCE_BY_COLLEGIATE', ''),       //線上開立折讓（通知開立）
    'AllowanceInvalid'            => env('ECPAY_ALLOWANCE_INVALID', ''),             //作廢折讓
    'GetAllowanceList'            => env('ECPAY_GET_ALLOWANCE_LIST', ''),            //查詢折讓明細
    'GetAllowanceInvalid'         => env('ECPAY_GET_ALLOWANCE_INVALID', ''),         //查詢作廢折讓明細
    'AllowanceInvalidByCollegiate' => env('ECPAY_ALLOWANCE_INVALID_BY_COLLEGIATE', ''), //取消線上折讓
];
