<?php

declare(strict_types=1);

namespace HttpConnect\HttpConnect\Validation\Exceptions;

use Exception;
use HttpConnect\HttpConnect\Validation\ValidatorMetadataInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class MetadataValidationFailedException extends Exception
{
    /**
     * @var ValidatorMetadataInterface
     */
    private $target;

    /**
     * @var ConstraintViolationListInterface
     */
    private $violations;

    /**
     * @return ValidatorMetadataInterface
     */
    public function getTarget(): ValidatorMetadataInterface
    {
        return $this->target;
    }

    /**
     * @param ValidatorMetadataInterface $target
     * @return void
     */
    public function setTarget(ValidatorMetadataInterface $target): void
    {
        $this->target = $target;
    }

    /**
     * @return ConstraintViolationListInterface
     */
    public function getViolations(): ConstraintViolationListInterface
    {
        return $this->violations;
    }

    /**
     * @param ConstraintViolationListInterface $violations
     * @return void
     */
    public function setViolations(ConstraintViolationListInterface $violations): void
    {
        $this->violations = $violations;
    }
}
