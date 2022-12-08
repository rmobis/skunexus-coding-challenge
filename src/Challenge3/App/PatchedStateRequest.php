<?php

namespace Interview\Challenge3\App;

use Interview\Challenge3\Vendor\{StateRequest, StateRequestInterface, StateRequestFactoryInterface};

class PatchedStateRequest implements StateRequestFactoryInterface
{
    public function __construct(private AvailableStateRepositoryInterface $repo) {}

    public function createFromGET(): StateRequestInterface
    {
		$factory = new StateRequest();
        $request = $factory->createFromGET();

        if ($this->repo && !in_array($request->getState(), $this->repo->all())) {
            throw new \DomainException("Passed state '{$request->getState()}' is not allowed");
        }

        return $request;
    }
}