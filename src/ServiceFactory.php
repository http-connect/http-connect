<?php

namespace StevanPavlovic\HttpConnect;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use StevanPavlovic\HttpConnect\Auth\NoAuth;
use StevanPavlovic\HttpConnect\Environment\EnvironmentInterface;
use StevanPavlovic\HttpConnect\Environment\ProductionEnvironment;
use Symfony\Component\HttpClient\CurlHttpClient;
use Symfony\Component\HttpClient\Psr18Client;

class ServiceFactory
{
    /**
     * @param ContainerInterface $actionPack
     * @param string|null $baseUri
     * @param EnvironmentInterface|null $environment
     * @return Service
     */
    public static function create(
        ContainerInterface $actionPack,
        ?string $baseUri = null,
        ?EnvironmentInterface $environment = null
    ): Service {
        return new Service($actionPack, $environment ?: static::createEnvironment($baseUri));
    }

    /**
     * @param string|null $baseUri
     * @return EnvironmentInterface
     */
    protected static function createEnvironment(?string $baseUri): EnvironmentInterface
    {
        $curlClient = new CurlHttpClient([
            'base_uri' => $baseUri ?: '/',
        ]);

        $curlClient->setLogger(static::createLogger(ProductionEnvironment::KEY));

        return new ProductionEnvironment(
            new NoAuth(),
            $baseUri,
            new Psr18Client($curlClient)
        );
    }

    /**
     * @param string $envKey
     * @return LoggerInterface
     */
    protected static function createLogger(string $envKey): LoggerInterface
    {
        return new Logger("http-connect::{$envKey}", [
            new StreamHandler(basename(__DIR__).'var/logs/http.log', Logger::DEBUG),
        ]);
    }
}
