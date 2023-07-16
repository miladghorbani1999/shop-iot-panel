<?php

namespace App\Services\DigikalaAdaptee\Facades;

use App\Services\DigikalaAdaptee\DigikalaAdapter;
use Illuminate\Support\Facades\Facade;

/**
 *
 * @method setAdaptee(string $service): static
 * @method setIdentifier(string $identifier): static
 * @method categories()
 */
class DigikalaFetch extends Facade
{

    public static function getFacadeAccessor()
    {
        return 'digikala';
    }
}
