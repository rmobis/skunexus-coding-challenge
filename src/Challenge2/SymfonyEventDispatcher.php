<?php

namespace Interview\Challenge2;

use Symfony\Component\EventDispatcher\EventDispatcher;

/*
 * Implement interface methods and proxy them to Symfony event dispatcher
 */
class SymfonyEventDispatcher implements EventDispatcherInterface
{
    public function __construct(private EventDispatcher $dispatcher) { }

    public function dispatch(object $event)
    {
        $this->dispatcher->dispatch($event);
    }

    public function addListener(string $eventClass, \Closure $listener)
    {
        $this->dispatcher->addListener($eventClass, $listener);
    }
}