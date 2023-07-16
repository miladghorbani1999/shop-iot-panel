<?php

namespace App\Services\DigikalaAdaptee\Concerns;

use JetBrains\PhpStorm\ArrayShape;

trait ResponseTrait
{

    #[ArrayShape(['success' => "bool", 'message' => "string", 'object' => "array"])]
    public function response(bool $success, string $messages, array $object = []): array
    {
        return [
            'success' => $success,
            'message' => $messages,
            'object' => $object
        ];
    }
}
