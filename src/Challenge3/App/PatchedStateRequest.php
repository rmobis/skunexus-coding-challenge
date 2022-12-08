<?php

namespace Interview\Challenge3\App;

use Interview\Challenge3\Vendor\{StateRequest, StateRequestInterface};

class PatchedStateRequest extends StateRequest {
	public function __construct(private ?AvailableStateRepositoryInterface $availableStateRepository = null) { }

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