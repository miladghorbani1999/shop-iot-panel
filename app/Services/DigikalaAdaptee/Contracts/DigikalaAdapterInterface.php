<?php

namespace App\Services\DigikalaAdaptee\Contracts;

interface DigikalaAdapterInterface
{
    public function setAdaptee(string $service): static;
    public function setIdentifier(string $identifier): static;
    public function category();
    public function product();
    public function search(int $page);
}
