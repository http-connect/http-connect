<?php

declare(strict_types=1);

namespace HttpConnect\HttpConnect\Action;

use HttpConnect\Standard\ActionInterface;
use HttpConnect\Standard\InputInterface;
use Nyholm\Psr7\Request;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriInterface;

abstract class Action implements ActionInterface
{
    final public function createRequest(InputInterface $input): RequestInterface
    {
        return new Request(
            $this->getMethod(),
            $this->createUri($input),
            $this->createHeaders($input),
            $this->createBody($input),
            $this->getHttpVersion($input)
        );
    }

    /**
     * @param InputInterface $input
     * @return array[]
     */
    protected function createHeaders(InputInterface $input): array
    {
        return [];
    }

    /**
     * @param InputInterface $input
     * @return StreamInterface|null
     */
    protected function createBody(InputInterface $input): ?StreamInterface
    {
        return null;
    }

    /**
     * @param InputInterface $input
     * @return string
     */
    protected function getHttpVersion(InputInterface $input): string
    {
        return '1.1';
    }

    /**
     * @return string
     */
    abstract protected function getMethod(): string;

    /**
     * Creates the URI.
     *
     * @param InputInterface $input
     * @return UriInterface
     */
    abstract protected function createUri(InputInterface $input): UriInterface;
}
