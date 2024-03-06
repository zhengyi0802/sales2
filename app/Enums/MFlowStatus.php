<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class MFlowStatus extends Enum
{
    const Unknown        =   0;  //未知
    const UnHandled      =   1;  //未處理
    const Processing     =   2;  //處理中
    const Shipping       =   3;  //出貨中
    const Arrived        =   4;  //已送達
}
