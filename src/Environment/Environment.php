<?php

namespace StevanPavlovic\HttpConnect\Environment;

use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Log\LoggerInterface;
use StevanPavlovic\HttpConnect\Auth\AuthInterface;
use Symfony\Component\HttpClient\CurlHttpClient;
use Symfony\Component\HttpClient\Psr18Client;

class Environment implements EnvironmentInterface
{
    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @param AuthInterface $auth
     * @param ContainerInterface|null $config
     * @param ClientInterface|null $client
     * @param LoggerInterface|null $logger
     */
    public function __construct(
        AuthInterface $auth,
        ContainerInterface $config,
        ?ClientInterface $client = null,
        ?LoggerInterface $logger = null
    ) {
        try {
            /** @var string $baseUri */
            $baseUri = $config->get('base_uri');
        } catch (NotFoundExceptionInterface $e) {
            $baseUri = '/';
        }

        if ($client === null) {
            $curlClient = new CurlHttpClient([
                'base_uri' => $baseUri,
            ]);

            if ($logger !== null) {
                $curlClient->setLogger($logger);
            }

            $client = new Psr18Client($curlClient);
        }

        $this->auth = $auth;
        $this->client = $client;
    }

    /**
     * @var AuthInterface
     */
    private $auth;

    /**
     * @return ClientInterface
     */
    public function getClient(): ClientInterface
    {
        return $this->client;
    }

    /**
     * @return AuthInterface
     */
    public function getAuth(): AuthInterface
    {
        return $this->auth;
    }

    /**
     * @inheritDoc
     */
    public function getConfig(): ContainerInterface
    {
        return $this->config;
    }
}
