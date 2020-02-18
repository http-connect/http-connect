<?php

namespace StevanPavlovic\HttpConnect\Environment;

use Psr\Container\ContainerInterface;
use Psr\Http\Client\ClientInterface;
use StevanPavlovic\HttpConnect\Auth\AuthInterface;

interface EnvironmentInterface
{
    /**
     * @return ClientInterface
     */
    public function getClient(): ClientInterface;

    /**
     * @return AuthInterface
     */
    public function getAuth(): AuthInterface;

    /**
     * @return ContainerInterface
     */
    public function getConfig(): ContainerInterface;
}
