<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

final class UserType extends Enum implements LocalizedEnum
{
    const User = 0;
    const Admin = 1;
}
