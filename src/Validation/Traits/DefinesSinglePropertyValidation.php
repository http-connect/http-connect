<?php

declare(strict_types=1);

namespace HttpConnect\HttpConnect\Validation\Traits;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

trait DefinesSinglePropertyValidation
{
    /**
     * @inheritDoc
     */
    final public static function loadValidatorMetadata(ClassMetadata $metadata): void
    {
        $metadata->addPropertyConstraints(self::$validatedPropertyName, self::getValidatorConstraints());
    }

    /**
     * @return Constraint[]
     */
    protected static function getValidatorConstraints(): array
    {
        return [
            new Assert\NotBlank(),
        ];
    }
}
