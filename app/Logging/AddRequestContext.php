<?php

declare(strict_types=1);

namespace App\Logging;

use Illuminate\Log\Logger;

/**
 * Adds request context processing to Laravel's rotating file channels.
 */
final class AddRequestContext
{
    public function __invoke(Logger $logger): void
    {
        $underlyingLogger = $logger->getLogger();

        if ($underlyingLogger instanceof \Monolog\Logger) {
            $underlyingLogger->pushProcessor(new RequestContextProcessor);
        }
    }
}
