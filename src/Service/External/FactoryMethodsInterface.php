<?php

declare(strict_types=1);

namespace HttpConnect\HttpConnect\Service\External;

use HttpConnect\Standard\Config\RepositoryInterface;
use HttpConnect\Standard\EnvironmentInterface;
use HttpConnect\Standard\AuthInterface;
use Psr\Http\Client\ClientInterface;

interface FactoryMethodsInterface
{
    /**
     * @param array $rawConfig
     * @return EnvironmentInterface
     */
    public static function createEnvironment(array $rawConfig): EnvironmentInterface;

    /**
     * @param RepositoryInterface $config
     * @return AuthInterface
     */
    public static function createAuth(RepositoryInterface $config): AuthInterface;

    /**
     * @param array $rawConfig
     * @return RepositoryInterface
     */
    public static function createConfig(array $rawConfig): RepositoryInterface;

    /**
     * @param RepositoryInterface $config
     * @return ClientInterface
     */
    public static function createClient(RepositoryInterface $config): ClientInterface;
}
