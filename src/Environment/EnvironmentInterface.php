<?php

declare(strict_types=1);

namespace HttpConnect\HttpConnect\Environment;

use HttpConnect\HttpConnect\Config\RepositoryInterface;
use Psr\Http\Client\ClientInterface;
use HttpConnect\HttpConnect\Auth\AuthInterface;
use Psr\Log\LoggerInterface;

interface EnvironmentInterface
{
    /**
     * @return string|null
     */
    public function getBaseUri(): ?string;

    /**
     * @return ClientInterface
     */
    public function getClient(): ClientInterface;

    /**
     * @return AuthInterface
     */
    public function getAuth(): AuthInterface;

    /**
     * @return RepositoryInterface
     */
    public function getConfig(): RepositoryInterface;

    /**
     * @return LoggerInterface|null
     */
    public function getLogger(): ?LoggerInterface;
}
