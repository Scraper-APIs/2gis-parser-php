<?php

declare(strict_types=1);

namespace TwoGisParser\Exception;

class RateLimitException extends ApiException
{
    public function __construct(
        string $message = 'Rate limit exceeded',
        public readonly int $retryAfter = 60,
    ) {
        parent::__construct($message);
    }
}
