<?php

namespace StevanPavlovic\HttpConnect\Environment;

use StevanPavlovic\HttpConnect\Auth\AuthInterface;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Psr18Client;
use Symfony\Component\HttpClient\Response\MockResponse;

final class TestEnvironment extends Environment
{
    /** @var string */
    public const KEY = 'test';

    /**
     * @param AuthInterface $auth
     * @param string|null $baseUri
     */
    public function __construct(AuthInterface $auth, ?string $baseUri = null)
    {
        parent::__construct($auth, $baseUri, new Psr18Client(
            new MockHttpClient([
                new MockResponse(),
            ], $baseUri)
        ));
    }

    /**
     * @inheritDoc
     */
    public function getKey(): string
    {
        return self::KEY;
    }
}
