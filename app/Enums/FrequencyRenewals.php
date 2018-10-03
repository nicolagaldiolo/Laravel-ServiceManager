<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class FrequencyRenewals extends Enum
{
    const Monthly = 0;
    const HalfYearly = 1;
    const Annual = 2;
    const Biennial = 3;
    const Quinquennial = 4;
}
