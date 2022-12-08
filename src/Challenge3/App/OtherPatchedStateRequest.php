<?php

namespace Interview\Challenge3\App;

use Interview\Challenge3\Vendor\{StateRequest, StateRequestFactoryInterface, StateRequestInterface};

class OtherPatchedStateRequest implements StateRequestFactoryInterface, StateRequestInterface
{
    private string $addressId;
    private string $state;

    public function __construct(private AvailableStateRepositoryInterface $repo) {}

    public function createFromGET(): StateRequestInterface
    {
        $addressId = (string)($_GET[StateRequest::ADDRESS_ID_KEY] ?? '');
        $state     = (string)($_GET[StateRequest::STATE_KEY] ?? '');

        if ($this->repo && !in_array($state, $this->repo->all())) {
            throw new \DomainException("Passed state '$state' is not allowed");
        }

        $request = new static($this->repo);

        $request->addressId = $addressId;
        $request->state = $state;

        return $request;
    }

    public function getAddressId(): string
    {
        return $this->addressId;
    }

    public function getState(): string
    {
        return $this->state;
    }
}