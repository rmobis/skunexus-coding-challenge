<?php

namespace Interview\Challenge3\Vendor;

interface AddressRepositoryInterface
{
    public function load(string $id): Address;

    public function update(Address $address): void;
}