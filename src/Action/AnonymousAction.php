<?php

namespace StevanPavlovic\HttpConnect\Action;

use Closure;
use InvalidArgumentException;
use Nyholm\Psr7\Stream;
use Nyholm\Psr7\Uri;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriInterface;
use Rize\UriTemplate;
use StevanPavlovic\HttpConnect\Action\Traits\Anonymous;
use StevanPavlovic\HttpConnect\Action\Traits\Undescribed;
use StevanPavlovic\HttpConnect\Transport\AnonymousInput;
use StevanPavlovic\HttpConnect\Transport\AnonymousResource;
use StevanPavlovic\HttpConnect\Transport\InputInterface;
use StevanPavlovic\HttpConnect\Transport\ResourceInterface;

final class AnonymousAction extends Action
{
    use Anonymous;
    use Undescribed;

    /**
     * @var string
     */
    private $method;

    /**
     * @var string
     */
    private $uriTemplate;

    /**
     * @var array
     */
    private $headers;

    /**
     * @var callable|null
     */
    private $bodyTransformer;

    /**
     * @var Closure|null
     */
    private $responseTransformer;

    /**
     * @var string
     */
    private $httpVersion;

    /**
     * @param string $method
     * @param string $uriTemplate
     * @param array $headers
     * @param Closure|null $bodyTransformer
     * @param Closure|null $responseTransformer
     * @param string $httpVersion
     */
    public function __construct(
        string $method,
        string $uriTemplate,
        array $headers = [],
        ?Closure $bodyTransformer = null,
        ?Closure $responseTransformer = null,
        string $httpVersion = '1.1'
    ) {
        $this->method = $method;
        $this->uriTemplate = $uriTemplate;
        $this->headers = $headers;
        $this->bodyTransformer = $bodyTransformer;
        $this->responseTransformer = $responseTransformer;
        $this->httpVersion = $httpVersion;
    }

    /**
     * @inheritDoc
     */
    protected function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @inheritDoc
     * @param AnonymousInput $input
     * @throws InvalidArgumentException
     */
    protected function createUri(InputInterface $input): UriInterface
    {
        $this->ensureInputIsAnonymous($input);

        return new Uri(
            (new UriTemplate())->expand($this->uriTemplate, $input->getData())
        );
    }

    /**
     * @inheritDoc
     */
    protected function createHeaders(InputInterface $input): array
    {
        return $this->headers;
    }

    /**
     * @inheritDoc
     * @param AnonymousInput $input
     * @throws InvalidArgumentException
     */
    protected function createBody(InputInterface $input): ?StreamInterface
    {
        $this->ensureInputIsAnonymous($input);
        $fn = $this->bodyTransformer;

        return Stream::create(
            $fn !== null ? $fn($input) : (string) $input
        );
    }

    /**
     * @inheritDoc
     */
    protected function getHttpVersion(InputInterface $input): string
    {
        return $this->httpVersion;
    }

    /**
     * @inheritDoc
     */
    public function transformResponse(ResponseInterface $response): ResourceInterface
    {
        $fn = $this->responseTransformer;
        $rawData = $response->getBody()->getContents();

        return new AnonymousResource(
            $fn !== null
                ? $fn($rawData)
                : json_decode($rawData, true, 512, JSON_THROW_ON_ERROR)
        );
    }

    /**
     * @param InputInterface $input
     * @return void
     * @throws InvalidArgumentException
     */
    private function ensureInputIsAnonymous(InputInterface $input): void
    {
        if (!$input instanceof AnonymousInput) {
            throw new InvalidArgumentException('Only AnonymousInput can be provided to an AnonymousAction.');
        }
    }
}
