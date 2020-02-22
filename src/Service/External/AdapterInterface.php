<?php

namespace HttpConnect\HttpConnect\Service\External;

use HttpConnect\HttpConnect\Service\External\Exceptions\RequirementNotMetException;

interface AdapterInterface extends FactoryMethodsInterface
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
