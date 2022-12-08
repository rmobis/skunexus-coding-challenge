<?php

namespace Interview\Misc;

use Illuminate\Container\Container;

class IoC
{
    public static function get(string $class): object
    {
        return Container::getInstance()->make($class);
    }

    public static function set(string $name, $mixed): void
    {
        Container::getInstance()->bind($name, $mixed);
    }
}