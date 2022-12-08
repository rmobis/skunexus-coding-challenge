<?php

use Interview\Challenge2\EventDispatcherInterface;
use Interview\Challenge2\LaravelEventDispatcher;
use Interview\Challenge2\SymfonyEventDispatcher;
use Interview\Misc\IoC;
use PHPUnit\Framework\TestCase;

class Challenge2Test extends TestCase
{
    public function test_laravel_dispatcher(): void
    {
        $this->assertDispatcherWorking(IoC::get(LaravelEventDispatcher::class));
    }

    public function test_symfony_dispatcher(): void
    {
        $this->assertDispatcherWorking(IoC::get(SymfonyEventDispatcher::class));
    }

    private function assertDispatcherWorking(EventDispatcherInterface $dispatcher): void
    {
        $event = new Event();
        $dispatched = false;

        $dispatcher->addListener(Event::class, function (Event $event) use (&$dispatched) {
            $dispatched = true;
        });

        $this->assertFalse($dispatched, 'Initial value should be false.');

        $dispatcher->dispatch($event);

        $this->assertTrue($dispatched, 'Event was not dispatched.');
    }
}

class Event
{
}