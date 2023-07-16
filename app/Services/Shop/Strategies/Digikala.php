<?php

namespace App\Services\Shop\Strategies;

use App\Services\DigikalaAdaptee\Facades\DigikalaFetch;
use App\Services\Shop\Contracts\StrategyInterface;

class Digikala implements StrategyInterface
{


    /**
     * @param string $identifier
     * @param string $entity
     * @return mixed
     */
    public function category(string $identifier, string $entity): mixed
    {
        return DigikalaFetch::setAdaptee($entity)
            ->setIdentifier($identifier)
            ->category();
    }

    public function product(string $identifier, string $entity): mixed
    {
        return DigikalaFetch::setAdaptee($entity)
            ->setIdentifier($identifier)
            ->product();
    }

    public function search(string $identifier, string $entity, int $page): mixed
    {
        return DigikalaFetch::setAdaptee($entity)
            ->setIdentifier($identifier)
            ->search($page);
    }
}
