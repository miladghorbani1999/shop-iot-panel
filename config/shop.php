<?php
return [
    'default_strategy' => \App\Enum\StrategyShopEnum::DIGIKALA->name,
    'default_service' => env('DEFAULT_SERVICE', \App\Enum\ServiceShopEnum::API->name),

    'strategies' => [
        \App\Enum\StrategyShopEnum::DIGIKALA->name => App\Services\Shop\Strategies\Digikala::class,
    ],

    \App\Enum\StrategyShopEnum::DIGIKALA->name => [
        'api_url' => env('API_URL_DIGIKALA'),
    ]

];
