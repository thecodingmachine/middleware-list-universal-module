<?php
declare(strict_types=1);

namespace TheCodingMachine;

use Interop\Container\ServiceProvider;

class MiddlewareListServiceProvider implements ServiceProvider
{
    const MIDDLEWARES_QUEUE = 'middlewaresQueue';
    const MIDDLEWARES_EXCEPTION_QUEUE = 'middlewaresExceptionQueue';
    const MIDDLEWARES_STRATIGILITY_EXCEPTION_QUEUE = 'middlewaresStratigilityExceptionQueue';

    public function getServices()
    {
        return [
            self::MIDDLEWARES_QUEUE => [self::class, 'createPriorityQueue'],
            self::MIDDLEWARES_EXCEPTION_QUEUE => [self::class,'createPriorityQueue'],
            self::MIDDLEWARES_STRATIGILITY_EXCEPTION_QUEUE => [self::class,'createPriorityQueue'],
        ];
    }

    public static function createPriorityQueue() : \SplPriorityQueue
    {
        return new \SplPriorityQueue();
    }
}
