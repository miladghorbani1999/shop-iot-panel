<?php

namespace App\Services\Shop\Contracts;

interface ShopInterface
{
    /**
     * @param string $strategy
     * @return $this
     */
    public function via(string $strategy): self;

    /**
     * @param string $string
     * @return $this
     */
    public function setEntity(string $string): static;

    /**
     * @param string $string
     * @return $this
     */
    public function setIdentifier(string $string): static;


    public function search(int $page);
    public function product();
    public function category();
}
