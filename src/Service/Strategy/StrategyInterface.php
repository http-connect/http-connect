<?php

namespace HttpConnect\HttpConnect\Service\Strategy;

use HttpConnect\HttpConnect\Environment\EnvironmentInterface;
use HttpConnect\HttpConnect\Service\Strategy\Exceptions\RequirementNotMetException;

interface StrategyInterface extends FactoryMethodsInterface
{
    /**
     * @return void
     * @throws RequirementNotMetException
     */
    public function checkRequirements(): void;

    /**
     * @return RequirementInterface[]
     */
    public function getRequirements(): array;
}
