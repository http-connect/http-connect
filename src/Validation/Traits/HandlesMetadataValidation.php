<?php

declare(strict_types=1);

namespace HttpConnect\HttpConnect\Validation\Traits;

use HttpConnect\Standard\Validation\Exceptions\MetadataValidationFailedException;
use HttpConnect\Standard\Validation\ValidatorMetadataInterface;

trait HandlesMetadataValidation
{
    use HasMetadataValidator;

    /**
     * @param ValidatorMetadataInterface $target
     * @throws MetadataValidationFailedException
     */
    protected function handleMetadataValidation(ValidatorMetadataInterface $target): void
    {
        $violations = $this->getValidator()->validate($target);

        if (count($violations) === 0) {
            return;
        }

        $e = new MetadataValidationFailedException((string) $violations);
        $e->setTarget($target);
        $e->setViolations($violations);

        throw $e;
    }
}
