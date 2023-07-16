<?php

namespace App\Services\Shop\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static via($string)
 */
class ShopFacade extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'shop';
    }
}
