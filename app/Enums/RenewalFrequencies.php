<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class RenewalFrequencies extends Enum implements LocalizedEnum
{
    const Days = 0;
    const Weeks = 1;
    const Months = 2;
    const Years = 3;
}
