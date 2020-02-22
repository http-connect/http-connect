<?php

namespace HttpConnect\HttpConnect\Validation;

use Symfony\Component\Validator\Mapping\ClassMetadata;

interface ValidatorMetadataInterface
{
    /**
     * @param ClassMetadata $metadata
     * @return void
     */
    public static function loadValidatorMetadata(ClassMetadata $metadata): void;
}
