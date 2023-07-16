<?php

namespace App\Services\DigikalaAdaptee\Contracts;

interface AdapteeInterface
{
    public function product(string $url);

    public function category(string $url);

    public function search(string $url);
}
