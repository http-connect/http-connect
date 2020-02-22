<?php

namespace HttpConnect\HttpConnect\Service\External\Exceptions;

use Exception;
use HttpConnect\HttpConnect\Service\External\RequirementInterface;
use Throwable;

class RequirementNotMetException extends Exception
{
    /**
     * @param string $strategyName
     * @param RequirementInterface $requirement
     * @param Throwable|null $previous
     */
    public function __construct(
        string $strategyName,
        RequirementInterface $requirement,
        ?Throwable $previous = null
    ) {
        parent::__construct(sprintf(
            '%s is not met for the usage of %s. %s',
            get_class($requirement),
            $strategyName,
            $requirement->getSolution()
        ), 1, $previous);
    }
}
