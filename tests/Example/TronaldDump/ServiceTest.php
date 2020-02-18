<?php

namespace HttpConnect\HttpConnect\Test\Example\TronaldDump;

use DateTimeImmutable;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientExceptionInterface;
use HttpConnect\HttpConnect\Example\TronaldDump\Quote\Action\GetRandomQuote;
use HttpConnect\HttpConnect\Example\TronaldDump\Quote\Transport\QuoteResource;
use HttpConnect\HttpConnect\Example\TronaldDump\Service as TronaldDumpService;
use HttpConnect\HttpConnect\Transport\AnonymousInput;
use HttpConnect\HttpConnect\Transport\Exceptions\InputValidationFailedException;

class ServiceTest extends TestCase
{
    /**
     * @throws ClientExceptionInterface
     * @throws InputValidationFailedException
     */
    public function testGetRandomQuoteReturnsResource(): void
    {
        $service = new TronaldDumpService();

        /** @var QuoteResource $quoteResource */
        $quoteResource = $service->call(GetRandomQuote::class, new AnonymousInput([]));

        $this->assertInstanceOf(QuoteResource::class, $quoteResource);
        $this->assertIsString($quoteResource->getValue());
        $this->assertInstanceOf(DateTimeImmutable::class, $quoteResource->getCreatedAt());
    }
}
