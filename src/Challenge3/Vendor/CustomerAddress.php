<?php

namespace Interview\Challenge3\Vendor;

class CustomerAddress
{
    private AddressRepositoryInterface $addressRepository;

    public function __construct(AddressRepositoryInterface $addressRepository)
    {
        $this->addressRepository = $addressRepository;
    }

    public function changeState(StateRequestInterface $stateRequest)
    {
        $address = $this->addressRepository->load($stateRequest->getAddressId());
        $address->changeState($stateRequest->getState());
        $this->addressRepository->update($address);
    }
}
