<?php

namespace StevanPavlovic\HttpConnect;

use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use StevanPavlovic\HttpConnect\Auth\NoAuth;
use StevanPavlovic\HttpConnect\Environment\EnvironmentInterface;
use StevanPavlovic\HttpConnect\Environment\Environment;
use Symfony\Component\HttpClient\CurlHttpClient;
use Symfony\Component\HttpClient\Psr18Client;

class ServiceFactory
{
    /**
     * @param ContainerInterface $actionPack
     * @param string|null $baseUri
     * @param EnvironmentInterface|null $environment
     * @param LoggerInterface|null $logger
     * @return Service
     */
    public static function create(
        ContainerInterface $actionPack,
        ?string $baseUri = null,
        ?EnvironmentInterface $environment = null,
        ?LoggerInterface $logger = null
    ): Service {
        return new Service(
            $actionPack,
            $environment ?: static::createEnvironment($baseUri, $logger)
        );
    }

    /**
     * @param string|null $baseUri
     * @param LoggerInterface|null $logger
     * @return EnvironmentInterface
     */
    protected static function createEnvironment(
        ?string $baseUri,
        ?LoggerInterface $logger
    ): EnvironmentInterface {
        $curlClient = new CurlHttpClient([
            'base_uri' => $baseUri ?: '/',
        ]);

        if ($logger !== null) {
            $curlClient->setLogger($logger);
        }

        return new Environment(
            new NoAuth(),
            $baseUri,
            new Psr18Client($curlClient)
        );
    }
}
