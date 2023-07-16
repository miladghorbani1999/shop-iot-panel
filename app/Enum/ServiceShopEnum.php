<?php

namespace App\Enum;

use App\Concerns\EnumToArray;

enum ServiceShopEnum: string
{
    use EnumToArray;

    case API = 'API';
    case CRAWLER = 'CRAWLER';
}
