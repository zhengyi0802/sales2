<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */

final class AFlowStatus extends Enum
{
    const Unknown        =   0;  //未知
    const UnHandled      =   1;  //未處理
    const BSProcess      =   2;  //業務處理中
    const CSProcess      =   3;  //客服處理中
    const Shipping       =   4;  //已寄出
    const Installed      =   5;  //已安裝
    const CaseClosed     =   6;  //已結案
    const ChargeBack     =   7;  //退單
    const Reconciled     =   8;  //已對賬
    const Transferable   =   9;  //可轉單
    const Transfered     =  10;  //已轉單
    const OrderReceived  =  11;  //已收單
    const ToBeArranged   =  12;  //待安排
    const Delivered      =  13;  //已交付
    const HasDone        =  14;  //已完成
}
