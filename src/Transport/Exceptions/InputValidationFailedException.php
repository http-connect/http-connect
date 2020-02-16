<?php

namespace StevanPavlovic\HttpConnect\Transport\Exceptions;

use Exception;
use StevanPavlovic\HttpConnect\Transport\InputInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class InputValidationFailedException extends Exception
{
    /**
     * @var InputInterface
     */
    private $input;

    /**
     * @var ConstraintViolationListInterface
     */
    private $violations;

    /**
     * @return InputInterface
     */
    public function getInput(): InputInterface
    {
        return $this->input;
    }

    /**
     * @param InputInterface $input
     * @return void
     */
    public function setInput(InputInterface $input): void
    {
        $this->input = $input;
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
