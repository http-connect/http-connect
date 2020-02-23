<?php

declare(strict_types=1);

namespace HttpConnect\HttpConnect\Service\External;

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
