<?php

namespace Interview\Challenge3\Vendor;

interface StateRequestFactoryInterface
{
    public function createFromGET(): StateRequestInterface;
}
