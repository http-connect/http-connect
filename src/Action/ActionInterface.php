<?php

namespace StevanPavlovic\HttpConnect\Action;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use StevanPavlovic\HttpConnect\Transport\InputInterface;
use StevanPavlovic\HttpConnect\Transport\ResourceInterface;

interface ActionInterface
{
    /** @var string */
    public const GET = 'GET';

    /** @var string */
    public const HEAD = 'HEAD';

    /** @var string */
    public const POST = 'POST';

    /** @var string */
    public const PUT = 'PUT';

    /** @var string */
    public const DELETE = 'DELETE';

    /** @var string */
    public const CONNECT = 'CONNECT';

    /** @var string */
    public const OPTIONS = 'OPTIONS';

    /** @var string */
    public const TRACE = 'TRACE';

    /** @var string */
    public const PATCH = 'PATCH';

    /**
     * @param InputInterface $input
     * @return RequestInterface
     */
    public function createRequest(InputInterface $input): RequestInterface;

    /**
     * @param ResponseInterface $response
     * @return ResourceInterface
     */
    public function transformResponse(ResponseInterface $response): ResourceInterface;

    /**
     * @return string|null
     */
    public function getName(): ?string;

    /**
     * @return string|null
     */
    public function getDescription(): ?string;
}
