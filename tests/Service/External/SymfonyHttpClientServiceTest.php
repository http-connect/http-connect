<?php

namespace HttpConnect\HttpConnect\Tests\Service\External;

use HttpConnect\HttpConnect\Action\AnonymousAction;
use HttpConnect\HttpConnect\Service\External\Exceptions\RequirementNotMetException;
use HttpConnect\HttpConnect\Service\External\GuzzleAdapterService;
use HttpConnect\HttpConnect\Service\External\SymfonyHttpClientAdapterService;
use HttpConnect\HttpConnect\Validation\Exceptions\MetadataValidationFailedException;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientExceptionInterface;

class SymfonyHttpClientServiceTest extends TestCase
{
    /**
     * @var GuzzleAdapterService
     */
    private $service;

    /**
     * @throws RequirementNotMetException
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->service = new SymfonyHttpClientAdapterService([
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
