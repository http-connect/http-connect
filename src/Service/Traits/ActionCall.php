<?php


namespace HttpConnect\HttpConnect\Service\Traits;


use HttpConnect\HttpConnect\Action\ActionInterface;
use HttpConnect\HttpConnect\Environment\EnvironmentInterface;
use HttpConnect\HttpConnect\Transport\InputInterface;
use HttpConnect\HttpConnect\Transport\ResourceInterface;
use HttpConnect\HttpConnect\Validation\Exceptions\MetadataValidationFailedException;
use HttpConnect\HttpConnect\Validation\Traits\HandlesMetadataValidation;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;

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
