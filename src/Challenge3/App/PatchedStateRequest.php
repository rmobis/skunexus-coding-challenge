<?php

namespace Interview\Challenge3\App;

use Interview\Challenge3\Vendor\StateRequest;
use Interview\Challenge3\Vendor\StateRequestInterface;
use Interview\Misc\IoC;

class PatchedStateRequest extends StateRequest {
	private AvailableStateRepositoryInterface $availableStateRepository;

	public function __construct() {
		$this->availableStateRepository = IoC::get(AvailableStateRepositoryInterface::class);
	}

    public function createFromGET(): StateRequestInterface
    {
        $request = parent::createFromGET();

		$this->validate($request);

        return $request;
    }

	private function validate(StateRequestInterface $request) {
		if (!in_array($request->getState(), $this->availableStateRepository->all())) {
            throw new \DomainException();
        }
	}
}