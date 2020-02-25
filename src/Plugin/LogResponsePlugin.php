<?php

declare(strict_types=1);

namespace HttpConnect\HttpConnect\Plugin;

use HttpConnect\Standard\Plugin\PluginInterface;
use HttpConnect\Standard\Plugin\Traits\AlwaysEnabled;
use HttpConnect\Standard\Plugin\Traits\DoesNotProcessAction;
use HttpConnect\Standard\Plugin\Traits\DoesNotProcessInput;
use HttpConnect\Standard\Plugin\Traits\DoesNotProcessRequest;
use HttpConnect\Standard\Plugin\Traits\DoesNotProcessResource;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;

class LogResponsePlugin implements PluginInterface
{
    use AlwaysEnabled;
    use DoesNotProcessAction;
    use DoesNotProcessInput;
    use DoesNotProcessResource;
    use DoesNotProcessRequest;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function processResponse(ResponseInterface $response): ResponseInterface
    {
        $this->logger->info($response->getReasonPhrase());

        return $response;
    }
}
