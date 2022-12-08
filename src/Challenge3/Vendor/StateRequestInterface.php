<?php

namespace Interview\Challenge3\Vendor;

interface StateRequestInterface
{
    public function getAddressId(): string;

    public function getState(): string;
}
