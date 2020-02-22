<?php

namespace HttpConnect\HttpConnect\Service\Strategy;

interface RequirementInterface
{
    /**
     * @return bool
     */
    public function isMet(): bool;

    /**
     * @return string
     */
    public function getSolution(): string;
}
