<?php

use Interview\Challenge3\Vendor\StateRequest;
use Interview\Challenge3\Vendor\StateRequestFactoryInterface;
use Interview\Misc\IoC;

IoC::set(StateRequestFactoryInterface::class, StateRequest::class);