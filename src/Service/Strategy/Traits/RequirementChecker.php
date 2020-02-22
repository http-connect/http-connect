<?php

namespace HttpConnect\HttpConnect\Service\Strategy\Traits;

use HttpConnect\HttpConnect\Environment\EnvironmentInterface;
use HttpConnect\HttpConnect\Service\Strategy\Exceptions\RequirementNotMetException;
use HttpConnect\HttpConnect\Service\Strategy\RequirementInterface;
use Psr\Container\ContainerInterface;

trait RequirementChecker
{
    /**
     * @param array $rawConfig
     * @param ContainerInterface $actionPack
     * @param EnvironmentInterface|null $environment
     * @throws RequirementNotMetException
     */
    final public function __construct(
        array $rawConfig = [],
        ?ContainerInterface $actionPack = null,
        ?EnvironmentInterface $environment = null
    ) {
        $this->checkRequirements();
        parent::__construct($actionPack, $environment ?: static::createEnvironment($rawConfig));
    }

    /**
     * @return void
     * @throws RequirementNotMetException
     */
    final public function checkRequirements(): void
    {
        foreach ($this->getRequirements() as $requirement) {
            if (!$requirement->isMet()) {
                throw new RequirementNotMetException($this, $requirement);
            }
        }
    }

    /**
     * @return RequirementInterface[]
     */
    public function getRequirements(): array
    {
        return [];
    }
}
