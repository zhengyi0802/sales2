<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class FlowStatus extends Enum
{
    const Unknown        =   0;  //未知
    const UnHandled      =   1;  //未處理
    const Contacted      =   2;  //已聯絡
    const Confirmed      =   3;  //已預約
    const Shipping       =   4;  //裝機中
    const Completion     =   5;  //已完成
    const Finished       =   6;  //已結案
    const ChargeBack     =   7;  //退單
}
