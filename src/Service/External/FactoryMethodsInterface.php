<?php

namespace HttpConnect\HttpConnect\Service\External;

use HttpConnect\HttpConnect\Auth\AuthInterface;
use HttpConnect\HttpConnect\Config\RepositoryInterface;
use HttpConnect\HttpConnect\Environment\EnvironmentInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Log\LoggerInterface;

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

    /**
     * @param RepositoryInterface $config
     * @return LoggerInterface
     */
    public static function createLogger(RepositoryInterface $config): LoggerInterface;
}
