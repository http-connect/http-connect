<?php

namespace HttpConnect\HttpConnect\Tests\Service\Strategy;

use HttpConnect\HttpConnect\Action\AnonymousAction;
use HttpConnect\HttpConnect\Service\Strategy\Exceptions\RequirementNotMetException;
use HttpConnect\HttpConnect\Service\Strategy\GuzzleService;
use HttpConnect\HttpConnect\Service\Strategy\SymfonyHttpClientService;
use HttpConnect\HttpConnect\Validation\Exceptions\MetadataValidationFailedException;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientExceptionInterface;

class SymfonyHttpClientServiceTest extends TestCase
{
    /**
     * @var GuzzleService
     */
    private $service;

    /**
     * @throws RequirementNotMetException
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->service = new SymfonyHttpClientService([
            'baseUri' => 'http://api.tronalddump.io/',
        ]);
    }

    /**
     * @throws MetadataValidationFailedException
     * @throws ClientExceptionInterface
     */
    public function testAnonymousCall(): void
    {
        $resource = $this->service->callAnonymous(new AnonymousAction(
            AnonymousAction::GET,
            'random/quote',
            [
                'Accept' => 'application/json'
            ]
        ));

        $data = $resource->getData();

        $this->assertArrayHasKey('appeared_at', $data);
        $this->assertArrayHasKey('created_at', $data);
        $this->assertArrayHasKey('quote_id', $data);
        $this->assertArrayHasKey('updated_at', $data);
        $this->assertArrayHasKey('value', $data);
    }
}
