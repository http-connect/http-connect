<?php

namespace HttpConnect\HttpConnect\Validation\Traits;

use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

trait HasMetadataValidator
{
    /**
     * @var ValidatorInterface|null
     */
    private $validator;

    /**
     * @return ValidatorInterface
     */
    protected function getValidator(): ValidatorInterface
    {
        if ($this->validator !== null) {
            return $this->validator;
        }

        return $this->validator = Validation::createValidatorBuilder()
            ->addMethodMapping('loadValidatorMetadata')
            ->getValidator();
    }
}
