<?php

declare(strict_types=1);

namespace HttpConnect\HttpConnect\Service\Traits;

use HttpConnect\Standard\Validation\Exceptions\MetadataValidationFailedException;
use HttpConnect\HttpConnect\Validation\Traits\HandlesMetadataValidation;
use HttpConnect\Standard\ActionInterface;
use HttpConnect\Standard\EnvironmentInterface;
use HttpConnect\Standard\InputInterface;
use HttpConnect\Standard\ResourceInterface;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

trait ActionCall
{
    use HandlesMetadataValidation;

    /**
     * @var EnvironmentInterface
     */
    protected $environment;

    /**
     * @param ActionInterface $action
     * @param InputInterface $input
     * @return ResourceInterface
     * @throws ClientExceptionInterface
     * @throws MetadataValidationFailedException
     */
    final protected function callAction(ActionInterface $action, InputInterface $input): ResourceInterface
    {
        $this->handleMetadataValidation($input);

        /** @var RequestInterface $request */
        $request = $this->environment->getAuth()->decorateRequest($action->createRequest($input));
        $response = $this->environment->getClient()->sendRequest($request);

        $this->createLog($response);

        return $action->transformResponse($response);
    }

    /**
     * @param ResponseInterface $response
     */
    private function createLog(ResponseInterface $response): void
    {
        if ($this->environment->getLogger() === null) {
            return;
        }

        $this->environment->getLogger()->info('nesto');
    }
}
