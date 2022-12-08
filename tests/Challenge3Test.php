<?php

use Interview\Challenge3\App\AvailableStateRepositoryInterface;
use Interview\Challenge3\Vendor\Address;
use Interview\Challenge3\Vendor\AddressRepositoryInterface;
use Interview\Challenge3\Vendor\Controller;
use Interview\Challenge3\Vendor\StateRequest;
use Interview\Misc\IoC;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class Challenge3Test extends TestCase
{
    private MockObject $addressRepositoryMock;

    private MockObject $stateRepositoryMock;

    private MockObject $addressMock;

    public function test_allows_to_change_state_to_verified(): void
    {
        $addressId = 'address' . rand(0, 100);
        $state     = 'verified' . rand(0, 100);

        $this->prepareGET($addressId, $state);
        $this->prepareStateRepositoryMock($state);
        $this->prepareAddressRepositoryMock($addressId);
        $this->prepareAddressMock($state);

        $this->loadApp();
    }

    private function prepareGET(string $addressId, string $state): void
    {
        $_GET[StateRequest::ADDRESS_ID_KEY] = $addressId;
        $_GET[StateRequest::STATE_KEY]      = $state;
    }

    private function prepareStateRepositoryMock($allowedState): void
    {
        $this
            ->stateRepositoryMock
            ->expects($this->once())
            ->method('all')
            ->willReturn([
                $allowedState
            ]);

    }

    private function prepareAddressRepositoryMock(string $addressId): void
    {
        $this
            ->addressRepositoryMock
            ->expects($this->once())
            ->method('load')
            ->with($addressId)
            ->willReturn($this->addressMock);

        $this
            ->addressRepositoryMock
            ->expects($this->once())
            ->method('update')
            ->with($this->addressMock);
    }

    private function prepareAddressMock(string $state): void
    {
        $this
            ->addressMock
            ->method('changeState')
            ->with($state);
    }

    private function loadApp()
    {
        require_once(__DIR__ . '/../src/Challenge3/Vendor/boot.php');
        require_once(__DIR__ . '/../src/Challenge3/App/boot.php');

        /** @var Controller $controller */
        $controller = IoC::get(Controller::class);
        $controller->changeStateAction();
    }

    public function test_forbids_changing_state_to_not_allowed_value(): void
    {
        $addressId = 'address' . rand(0, 100);
        $state     = 'invalid' . rand(0, 100);

        $this->prepareGET($addressId, $state);

        $this->expectException(\DomainException::class);

        $this->loadApp();
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->addressRepositoryMock = $this->createMock(AddressRepositoryInterface::class);
        $this->stateRepositoryMock   = $this->createMock(AvailableStateRepositoryInterface::class);

        IoC::set(
            AddressRepositoryInterface::class,
            function () {
                return $this->addressRepositoryMock;
            }
        );

        IoC::set(
            AvailableStateRepositoryInterface::class,
            function () {
                return $this->stateRepositoryMock;
            }
        );

        $this->addressMock = $this->createMock(Address::class);
    }
}
