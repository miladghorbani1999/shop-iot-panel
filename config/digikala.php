<?php
return [
    'drivers' => [
        \App\Enum\ServiceShopEnum::API->name => \App\Services\DigikalaAdaptee\Adaptee\ApiAdapter::class,
        \App\Enum\ServiceShopEnum::CRAWLER->name => \App\Services\DigikalaAdaptee\Adaptee\CrawlerAdapter::class,
    ],

];
