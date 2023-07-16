<?php

namespace App\Enum;

use App\Concerns\EnumToArray;

enum ImageTypeEnum:string
{
    use EnumToArray;

    case GALLERY = 'GALLERY';
    case LIST = 'LIST';
    case LOGO = 'LOGO';
}
