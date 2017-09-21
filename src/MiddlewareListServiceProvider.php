<?php

declare (strict_types = 1);

namespace TheCodingMachine;

use Interop\Container\ServiceProviderInterface;

class MiddlewareListServiceProvider implements ServiceProviderInterface
{
    const MIDDLEWARES_QUEUE = 'middlewaresQueue';

    public function getFactories()
    {
        return [
            self::MIDDLEWARES_QUEUE => [self::class, 'createPriorityQueue'],
        ];
    }

    public static function createPriorityQueue() : \SplPriorityQueue
    {
        return new \SplPriorityQueue();
    }

    public function getExtensions()
    {
        return [];
    }
}
