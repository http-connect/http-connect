<?php

namespace HttpConnect\HttpConnect\Example\TronaldDump\Quote\Action;

use DateTimeImmutable;
use Nyholm\Psr7\Uri;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;
use HttpConnect\HttpConnect\Action\Action;
use HttpConnect\HttpConnect\Example\TronaldDump\Quote\Transport\QuoteResource;
use HttpConnect\HttpConnect\Transport\InputInterface;
use HttpConnect\HttpConnect\Transport\ResourceInterface;

final class GetRandomQuote extends Action
{
    /**
     * @inheritDoc
     */
    protected function getMethod(): string
    {
        return static::GET;
    }

    /**
     * @inheritDoc
     */
    protected function createUri(InputInterface $input): UriInterface
    {
        return new Uri('random/quote');
    }

    /**
     * @inheritDoc
     * @return QuoteResource
     * @throws \Exception
     */
    public function transformResponse(ResponseInterface $response): ResourceInterface
    {
        $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);

        return new QuoteResource(
            $data['quote_id'],
            $data['value'],
            $data['tags'],
            new DateTimeImmutable($data['created_at']),
            new DateTimeImmutable($data['updated_at']),
            new DateTimeImmutable($data['appeared_at']),
            $data['_embedded']
        );
    }

    /**
     * @inheritDoc
     */
    public function getName(): ?string
    {
        return 'Random Quote';
    }

    /**
     * @inheritDoc
     */
    public function getDescription(): ?string
    {
        return 'Retrieve a random quote';
    }
}
