# http-interop middleware list universal module

This package simply providers an http-interop middleware list to any [container-interop](https://github.com/container-interop/service-provider) compatible framework/container.
The middleware list is **empty**. Any package can come and add a middleware to the list. 

## Installation

This package is typically used by packages providing middlewares.

```
composer require thecodingmachine/middleware-list-universal-module
```

If your container supports autodiscovery by Puli, there is nothing more to do.
Otherwise, you need to register the [`TheCodingMachine\MiddlewareListServiceProvider`](src/MiddlewareListServiceProvider.php) into your container.

Refer to your framework or container's documentation to learn how to register *service providers*.

## Usage

This module registers 3 services in your container:

- The middleware queue is registered under the key `MiddlewareListServiceProvider::MIDDLEWARES_QUEUE`. This is a `\SPLPriorityQueue`.

Now, depending on whether you are using [Stratigility](https://github.com/zendframework/zend-stratigility) or another PSR-7 middleware consumer (like [Relay](http://relayphp.com/)), the way exceptions routers are handled is different.

Stratigility uses a special format for error middlewares. We have therefore decided to split the error middlewares in 2 different lists:

- The error middleware queue for "normal" middleware routers is registered under the key `MiddlewareListServiceProvider::MIDDLEWARES_EXCEPTION_QUEUE`. This is a `\SPLPriorityQueue`.
- The error middleware queue for Stratigility is registered under the key `MiddlewareListServiceProvider::MIDDLEWARES_STRATIGILITY_EXCEPTION_QUEUE`. This is a `\SPLPriorityQueue`.


Depending on the middleware you are registering, you generally have a fairly good idea of the order it should run compared to other middlewares.

Let's split the middlewares in 4 families:

- **Utility middlewares**: those are typically handled at the beginning of a request. They are used to modify/enrich the response and pass it to other middlewares.
  In this category, you would put middlewares that compute the response time, middlewares that add geolocation information, middlewares that manage sessions, etc...
- **Routers**: those are middlewares that are typically used to handle a request and return a response. They respond on specific routes or pass the request along to the next router if they don't know that route.
- **Page not found routers**: those are middlewares in charge of answering a 404 answer if no middleware has handled the request. This is the last "classical" middleware of the queue.
- **Error handling middlewares**: Finally, at the very end of the queue, you will find the list of middlewares that handle errors and exceptions. They are in charge of logging or displaying error messages.

Based on those 4 families, the `MiddlewareListServiceProvider` provides a SPL Priority Queue that one can use to register any middleware at the right point in the queue.

The service provider defines 12 constants you can use to insert a middleware at a given point:
    
- `MiddlewareOrder::EXCEPTION_EARLY` (3050)
- `MiddlewareOrder::EXCEPTION` (3000)
- `MiddlewareOrder::EXCEPTION_LATE` (2950)
- `MiddlewareOrder::UTILITY_EARLY` (2050)
- `MiddlewareOrder::UTILITY` (2000)
- `MiddlewareOrder::UTILITY_LATE` (1950)
- `MiddlewareOrder::ROUTER_EARLY` (1050)
- `MiddlewareOrder::ROUTER` (1000)
- `MiddlewareOrder::ROUTER_LATE` (950)
- `MiddlewareOrder::PAGE_NOT_FOUND_EARLY` (50)
- `MiddlewareOrder::PAGE_NOT_FOUND` (0)
- `MiddlewareOrder::PAGE_NOT_FOUND_LATE` (-50)

Each "family" has 3 variants: EARLY, NORMAL and LATE, so you can add more fine grained tuning if you want a utility to be triggered before another one, etc...

So if you want to register a middleware, you would typically write:

```php
$middlewareQueue = $container->get(MiddlewareListServiceProvider::MIDDLEWARES_QUEUE);
/* @var $middlewareQueue \SplPriorityQueue */
$middlewareQueue->insert($myMiddleware, MiddlewareOrder::UTILITY);
```
