<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class RenewalSM extends Enum implements LocalizedEnum
{
    const S_to_confirm = '0';
    const S_to_bill = '1';
    const S_to_cash = '2';
    const S_payed = '3';
    const S_suspended = '4';

    const T_back_to_bill = 'to_bill';
    const T_back_to_cash = 'to_cash';
    const T_back_to_confirm = 'to_confirm';
    const T_renews = 'renews';
    const T_suspend = 'suspend';
    const T_invoice = 'invoice';
    const T_payed = 'payed';
}
