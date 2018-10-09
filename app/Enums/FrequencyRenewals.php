<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class FrequencyRenewals extends Enum implements LocalizedEnum
{
    const Weekly = 0;
    const Monthly = 1;
    const HalfYearly = 2;
    const Annual = 3;
    const Biennial = 4;
    const Triennial = 5;
    const Quadrennial = 6;
    const Quinquennial = 7;
}
