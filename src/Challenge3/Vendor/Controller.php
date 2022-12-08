<?php

namespace Interview\Challenge3\Vendor;

class Controller
{
    private $factory;
    private $service;

    public function __construct(
        StateRequestFactoryInterface $factory,
        AddressRepositoryInterface $repository
    )
    {
        $this->factory = $factory;
        $this->service = new CustomerAddress($repository);
    }

    public function changeStateAction()
    {
        $this->service->changeState(
            $this->factory->createFromGET()
        );
    }

}