<?php

declare(strict_types=1);

namespace HttpConnect\HttpConnect\Transport\Traits;

use Symfony\Component\Validator\Mapping\ClassMetadata;

trait HasNoValidation
{
    /**
     * @param ClassMetadata $metadata
     */
    public static function loadValidatorMetadata(ClassMetadata $metadata): void
    {
    }
}
