<?php

namespace StevanPavlovic\HttpConnect\Test\Example\TronaldDump;

use DateTimeImmutable;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientExceptionInterface;
use StevanPavlovic\HttpConnect\Example\TronaldDump\Quote\Action\GetRandomQuote;
use StevanPavlovic\HttpConnect\Example\TronaldDump\Quote\Transport\QuoteResource;
use StevanPavlovic\HttpConnect\Example\TronaldDump\Service as TronaldDumpService;
use StevanPavlovic\HttpConnect\Transport\AnonymousInput;
use StevanPavlovic\HttpConnect\Transport\Exceptions\InputValidationFailedException;

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
