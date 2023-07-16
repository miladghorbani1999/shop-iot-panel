<?php

namespace App\Services\Shop\Contracts;

interface StrategyInterface
{
    /**
     * @param string $identifier
     * @param string $entity
     * @return mixed
     */
    public function category(string $identifier, string $entity): mixed;

    public function product(string $identifier, string $entity): mixed;

    public function search(string $identifier, string $entity, int $page): mixed;
}
