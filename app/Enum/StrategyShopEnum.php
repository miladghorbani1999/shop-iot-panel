<?php

namespace App\Enum;

use App\Concerns\EnumToArray;

enum StrategyShopEnum: string
{
    use EnumToArray;

    case DIGIKALA = 'DIGIKALA';
    case ALIBABA = 'ALIBABA';
    case AMAZON = 'AMAZON';

}
