<?php

namespace App\Sync\Handler;

class ApiSourceHandlerResolver
{
    public function resolve(string $provider): ApiSourceHandler
    {
        return match ($provider) {
            'firstclass' => app(FirstclassApiSourceHandler::class),

            default => app(GenericApiSourceHandler::class),
        };
    }
}