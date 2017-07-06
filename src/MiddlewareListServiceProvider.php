<?php

declare (strict_types = 1);

namespace TheCodingMachine;

use Interop\Container\ServiceProvider;

class MiddlewareListServiceProvider implements ServiceProvider
{
    const MIDDLEWARES_QUEUE = 'middlewaresQueue';

    public function getServices()
    {
        return [
            self::MIDDLEWARES_QUEUE => [self::class, 'createPriorityQueue'],
        ];
    }

    public static function createPriorityQueue() : \SplPriorityQueue
    {
        return new \SplPriorityQueue();
    }
}
