<?php

namespace Interview\Challenge3\App;

use Interview\Challenge3\Vendor\{StateRequest, StateRequestFactoryInterface, StateRequestInterface};

class OtherValidStateRequest extends StateRequest
{
    public function __construct(private ?AvailableStateRepositoryInterface $repo = null) {}

    public function createFromGET(): StateRequestInterface
    {
        $state = (string)($_GET[self::STATE_KEY] ?? '');

        if ($this->repo && !in_array($state, $this->repo->all())) {
            throw new \DomainException("State not allowed");
        }

        return parent::createFromGET();
    }
}