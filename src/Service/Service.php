<?php

declare(strict_types=1);

namespace HttpConnect\HttpConnect\Service;

use HttpConnect\HttpConnect\Action\ActionPack;
use HttpConnect\HttpConnect\Service\Traits\ConventionalCalls;
use HttpConnect\Standard\EnvironmentInterface;
use HttpConnect\Standard\Plugin\PluginInterface;
use HttpConnect\Standard\ServiceInterface;
use Psr\Container\ContainerInterface;

class Service implements ServiceInterface
{
    use ConventionalCalls;

    /**
     * @param ContainerInterface $actionPack
     * @param EnvironmentInterface $environment
     */
    public function __construct(
        ?ContainerInterface $actionPack,
        EnvironmentInterface $environment
    ) {
        $this->actionPack = $actionPack ?: static::createActionPack();
        $this->environment = $environment;
    }

    /**
     * @return ContainerInterface
     */
    final public function getActionPack(): ContainerInterface
    {
        return $this->actionPack;
    }

    /**
     * @return PluginInterface[]
     */
    public function getPlugins(): array
    {
        return [];
    }

    /**
     * @return ContainerInterface
     */
    protected static function createActionPack(): ContainerInterface
    {
        return new ActionPack([]);
    }
}
