<?php

namespace Interview\Challenge2;

use Illuminate\Events\Dispatcher as LaravelDispatcher;

/*
 * Implement interface methods and proxy them to Laravel event dispatcher
 */
class LaravelEventDispatcher implements EventDispatcherInterface
{
    public function __construct(private LaravelDispatcher $dispatcher) { }

    public function dispatch(object $event)
    {
        $this->dispatcher->dispatch($event);
    }

    public function addListener(string $eventClass, \Closure $listener)
    {
        $this->dispatcher->listen($eventClass, $listener);
    }
}