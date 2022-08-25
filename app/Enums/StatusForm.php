<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static WAITING
 * @method static APPROVED
 */
final class StatusForm extends Enum
{
    const WAITING =   0;
    const APPROVED =   1;
}
