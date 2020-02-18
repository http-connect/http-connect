<?php

namespace HttpConnect\HttpConnect\Transport;

use Symfony\Component\Validator\Mapping\ClassMetadata;

interface InputInterface
{
    /**
     * @param ClassMetadata $metadata
     * @return void
     */
    public static function loadValidatorMetadata(ClassMetadata $metadata): void;

    /**
     * @return string
     */
    public function __toString(): string;
}
