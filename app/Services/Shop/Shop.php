<?php

namespace App\Services\Shop;

use App\Services\Shop\Contracts\ShopInterface;
use App\Services\Shop\Contracts\StrategyInterface;
use Illuminate\Contracts\Container\BindingResolutionException;

class Shop implements ShopInterface
{

    protected StrategyInterface $strategy;
    protected string $entity;
    protected string $identifier;

    /**
     * @throws BindingResolutionException
     */
    public function __construct()
    {
        $defaultStrategy = config('shop.default_strategy');
        $this->strategy = app()->make(config('shop.strategies.' . $defaultStrategy));
    }


    /**
     * change strategy
     * @throws BindingResolutionException
     */
    public function via(string $strategy): ShopInterface
    {
        $this->strategy = app()->make(config('shop.strategies.' . $strategy));

        return $this;
    }

    public function setEntity(string $string): static
    {
        $this->entity = $string;
        return $this;
    }

    public function setIdentifier(string $string): static
    {
        $this->identifier = $string;
        return $this;
    }

    public function category()
    {
        return $this->strategy->category(
            $this->identifier,
            $this->entity,
        );
    }

    public function search(int $page)
    {
        return $this->strategy->search(
            $this->identifier,
            $this->entity,
            $page,
        );
    }

    public function product()
    {
        return $this->strategy->product(
            $this->identifier,
            $this->entity,
        );
    }
}
