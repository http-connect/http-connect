<?php

namespace HttpConnect\HttpConnect\Transport;

use HttpConnect\HttpConnect\Validation\ValidatorMetadataInterface;

interface InputInterface extends ValidatorMetadataInterface
{
    /**
     * @return string
     */
    public function __toString(): string;
}
