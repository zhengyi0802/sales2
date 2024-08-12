<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class UserRole extends Enum
{
    const System        =   0;  //系統
    const Administrator =   1;  //超級管理者
    const CEO           =   2;  //CEO
    const Manager       =   3;  //管理者
    const Accounter     =   4;  //會計
    const Sales         =   5;  //代理經銷商
    const Operator      =   6;  //輸入者/
    const Installer     =   7;  //工班
    const Reseller      =   8;  //經銷加盟商
    const ShareHolder   =   9;  //股東
    const Stocker       =  10;  //蒼管人員
    const CSR           =  11;  //客服
}
