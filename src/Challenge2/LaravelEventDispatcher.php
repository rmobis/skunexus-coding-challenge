<?php

namespace Interview\Challenge2;

use Illuminate\Events\Dispatcher;

/*
 * Implement interface methods and proxy them to Laravel event dispatcher
 */
class LaravelEventDispatcher implements EventDispatcherInterface
{
    public function __construct(private Dispatcher $dispatcher) {}

    public function dispatch(object $event)
    {
        $this->dispatcher->dispatch($event);
    }

    public function addListener(string $event, \Closure $listener)
    {
        $this->dispatcher->listen($event, $listener);
    }
}