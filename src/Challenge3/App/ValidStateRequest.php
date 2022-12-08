<?php

namespace Interview\Challenge3\App;

use Interview\Challenge3\Vendor\{StateRequestFactoryInterface, StateRequestInterface};

class ValidStateRequest implements StateRequestFactoryInterface, StateRequestInterface
{
    public const ADDRESS_ID_KEY = 'address_id';
    public const STATE_KEY      = 'state';

    private string $addressId;

    private string $state;

    public function __construct(private AvailableStateRepositoryInterface $repo) {}

    public function createFromGET(): StateRequestInterface
    {
        $addressId = (string)($_GET[self::ADDRESS_ID_KEY] ?? '');
        $state     = (string)($_GET[self::STATE_KEY] ?? '');

        if ($this->repo && !in_array($state, $this->repo->all())) {
            throw new \DomainException("State not allowed");
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