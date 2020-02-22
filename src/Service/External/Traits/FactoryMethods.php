<?php

namespace HttpConnect\HttpConnect\Service\External\Traits;

use HttpConnect\HttpConnect\Auth\AuthInterface;
use HttpConnect\HttpConnect\Auth\NoAuth;
use HttpConnect\HttpConnect\Config\Config;
use HttpConnect\HttpConnect\Config\RepositoryInterface;
use HttpConnect\HttpConnect\Environment\Environment;
use HttpConnect\HttpConnect\Environment\EnvironmentInterface;
use HttpConnect\HttpConnect\Validation\Exceptions\MetadataValidationFailedException;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Log\LoggerInterface;

trait FactoryMethods
{
    /**
     * @param array $rawConfig
     * @return EnvironmentInterface
     * @throws MetadataValidationFailedException
     */
    public static function createEnvironment(array $rawConfig): EnvironmentInterface
    {
        $config = static::createConfig($rawConfig);

        return new Environment(
            static::createAuth($config),
            $config,
            static::createClient($config),
            static::createLogger($config)
        );
    }

    /**
     * @param array $rawConfig
     * @return RepositoryInterface
     * @throws MetadataValidationFailedException
     */
    public static function createConfig(array $rawConfig): RepositoryInterface
    {
        $config = [
            'baseUri' => $rawConfig['baseUri'] ?? null,
            'serviceId' => $rawConfig['serviceId'] ?? uniqid('http-connect-service-', true),
            'serviceName' => $rawConfig['serviceName'] ?? null,
            'serviceDescription' => $rawConfig['serviceDescription'] ?? null,
            'logFilePath' => $rawConfig['logFilePath'] ?? dirname(__DIR__, 4) . '/var/logs/api.log',
        ];

        return new Config($config);
    }

    /**
     * @param RepositoryInterface $config
     * @return AuthInterface
     */
    public static function createAuth(RepositoryInterface $config): AuthInterface
    {
        return new NoAuth();
    }

    /**
     * @param RepositoryInterface $config
     * @return LoggerInterface|null
     */
    public static function createLogger(RepositoryInterface $config): LoggerInterface
    {
        return new Logger($config->get('serviceId'), [
            new StreamHandler($config->get('logFilePath'))
        ]);
    }
}
