<?php

namespace StevanPavlovic\HttpConnect\Environment;

use Psr\Http\Client\ClientInterface;
use Psr\Log\LoggerInterface;
use StevanPavlovic\HttpConnect\Auth\AuthInterface;
use Symfony\Component\HttpClient\CurlHttpClient;
use Symfony\Component\HttpClient\Psr18Client;

abstract class Environment implements EnvironmentInterface
{
    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var AuthInterface
     */
    private $auth;

    /**
     * @param AuthInterface $auth
     * @param string|null $baseUri
     * @param ClientInterface|null $client
     * @param LoggerInterface|null $logger
     */
    public function __construct(
        AuthInterface $auth,
        ?string $baseUri = null,
        ?ClientInterface $client = null,
        ?LoggerInterface $logger = null
    ) {
        if ($client === null) {
            $curlClient = new CurlHttpClient([
                'base_uri' => $baseUri ?: '/',
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
}
