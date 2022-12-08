<?php

namespace Interview\Challenge3\Vendor;

class StateRequest implements StateRequestFactoryInterface, StateRequestInterface
{
    public const ADDRESS_ID_KEY = 'address_id';
    public const STATE_KEY      = 'state';

    private string $addressId;

    private string $state;

    public function createFromGET(): StateRequestInterface
    {
        $request = new static();

        $request->addressId = (string)($_GET[self::ADDRESS_ID_KEY] ?? '');
        $request->state     = (string)($_GET[self::STATE_KEY] ?? '');

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
