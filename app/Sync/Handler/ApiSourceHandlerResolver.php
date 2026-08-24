<?php

namespace App\Sync\Handler;

class ApiSourceHandlerResolver
{
    public function resolve(string $provider): ApiSourceHandler
    {
        return match ($provider) {
            // 'special' => app(SpecialApiSourceHandler::class),
            default => app(ApiSourceHandler::class),
        };
    }
}