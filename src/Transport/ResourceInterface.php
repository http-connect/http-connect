<?php

declare(strict_types=1);

namespace HttpConnect\HttpConnect\Transport;

interface ResourceInterface
{
    /**
     * @return string
     */
    public function __toString(): string;
}
