<?php

declare(strict_types=1);

namespace HttpConnect\HttpConnect\Plugin;

use HttpConnect\Standard\Plugin\PluginInterface;
use HttpConnect\Standard\Plugin\Traits\AlwaysEnabled;
use HttpConnect\Standard\Plugin\Traits\DoesNotProcessAction;
use HttpConnect\Standard\Plugin\Traits\DoesNotProcessInput;
use HttpConnect\Standard\Plugin\Traits\DoesNotProcessResource;
use HttpConnect\Standard\Plugin\Traits\DoesNotProcessResponse;
use Psr\Http\Message\RequestInterface;
use Psr\Log\LoggerInterface;

class LogRequestPlugin implements PluginInterface
{
    use AlwaysEnabled;
    use DoesNotProcessAction;
    use DoesNotProcessInput;
    use DoesNotProcessResource;
    use DoesNotProcessResponse;

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
     * @param RequestInterface $request
     * @return RequestInterface
     */
    public function processRequest(RequestInterface $request): RequestInterface
    {
        $this->logger->info($request->getMethod());

        return $request;
    }
}
