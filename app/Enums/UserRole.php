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
    const Manager       =   2;  //管理者
    const Accounter     =   3;  //會計
    const Sales         =   4;  //代理經銷商
    const Operator      =   5;  //輸入者/
    const Installer     =   6;  //工班
    const Reseller      =   7;  //經銷加盟商
    const ShareHolder   =   8;  //股東
    const Stocker       =   9;  //蒼管人員
    const CSR           =  10;  //客服
}
