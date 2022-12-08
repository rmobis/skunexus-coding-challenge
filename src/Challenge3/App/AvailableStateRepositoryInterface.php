<?php

namespace Interview\Challenge3\App;

interface AvailableStateRepositoryInterface
{
    /**
     * @return string[]
     */
    public function all(): array;
}