<?php

namespace Interview\Challenge2;

interface EventDispatcherInterface
{
    public function dispatch(object $event);

    /**
     * @var string $event (FQCN of the event class)
     * @var \Closure $listener (which accepts event as first argument)
     */
    public function addListener(string $event, \Closure $listener);
}