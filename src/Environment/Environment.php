<?php

declare(strict_types=1);

namespace HttpConnect\HttpConnect\Environment;

use HttpConnect\Standard\Config\RepositoryInterface;
use HttpConnect\Standard\AuthInterface;
use HttpConnect\Standard\EnvironmentInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Log\LoggerInterface;

class Environment implements EnvironmentInterface
{
    /**
     * @var string|null
     */
    private $baseUri;

    /**
     * @var AuthInterface
     */
    private $auth;

    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var RepositoryInterface
     */
    private $config;

    /**
     * @param AuthInterface $auth
     * @param RepositoryInterface $config
     * @param ClientInterface|null $client
     */
    public function __construct(
        AuthInterface $auth,
        RepositoryInterface $config,
        ?ClientInterface $client = null
    ) {
        try {
            /** @var string $baseUri */
            $baseUri = $config->get('base_uri');
        } catch (NotFoundExceptionInterface $e) {
            $baseUri = null;
        }

        $this->baseUri = $baseUri;
        $this->auth = $auth;
        $this->client = $client;
        $this->config = $config;
    }

    /**
     * @inheritDocsudo apt update
     */
    public function getBaseUri(): ?string
    {
        return $this->baseUri;
    }

    /**
     * @inheritDoc
     */
    public function getAuth(): AuthInterface
    {
        return $this->auth;
    }

    /**
     * @inheritDoc
     */
    public function getClient(): ClientInterface
    {
        return $this->client;
    }

    /**
     * @inheritDoc
     */
    public function getConfig(): RepositoryInterface
    {
        return $this->config;
    }

    /**
     * @inheritDoc
     */
    public function getLogger(): ?LoggerInterface
    {
        return null;
    }
}
