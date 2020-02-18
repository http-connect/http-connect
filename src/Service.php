<?php

namespace HttpConnect\HttpConnect;

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\RequestInterface;
use HttpConnect\HttpConnect\Action\ActionInterface;
use HttpConnect\HttpConnect\Action\AnonymousAction;
use HttpConnect\HttpConnect\Environment\EnvironmentInterface;
use HttpConnect\HttpConnect\Transport\AnonymousInput;
use HttpConnect\HttpConnect\Transport\AnonymousResource;
use HttpConnect\HttpConnect\Transport\Exceptions\InputValidationFailedException;
use HttpConnect\HttpConnect\Transport\InputInterface;
use HttpConnect\HttpConnect\Transport\ResourceInterface;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class Service
{
    /**
     * @var ContainerInterface
     */
    private $actionPack;

    /**
     * @var EnvironmentInterface
     */
    private $environment;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @param ContainerInterface $actionPack
     * @param EnvironmentInterface $environment
     */
    public function __construct(
        ContainerInterface $actionPack,
        EnvironmentInterface $environment
    ) {
        $this->actionPack = $actionPack;
        $this->environment = $environment;
        $this->validator = Validation::createValidatorBuilder()
            ->addMethodMapping('loadValidatorMetadata')
            ->getValidator();
    }

    /**
     * @param string $key
     * @param InputInterface $input
     * @return ResourceInterface
     * @throws ContainerExceptionInterface
     * @throws InputValidationFailedException
     * @throws ClientExceptionInterface
     */
    public function call(string $key, InputInterface $input): ResourceInterface
    {
        /** @var ActionInterface $action */
        $action = $this->actionPack->get($key);

        return $this->callAction($action, $input);
    }

    /**
     * @param AnonymousAction $action
     * @param AnonymousInput $input
     * @return AnonymousResource
     * @throws ClientExceptionInterface
     * @throws InputValidationFailedException
     */
    public function callAnonymous(AnonymousAction $action, ?AnonymousInput $input = null): ResourceInterface
    {
        return $this->callAction($action, $input ?: new AnonymousInput([]));
    }

    /**
     * @param ActionInterface $action
     * @param InputInterface $input
     * @return ResourceInterface
     * @throws ClientExceptionInterface
     * @throws InputValidationFailedException
     */
    final protected function callAction(ActionInterface $action, InputInterface $input): ResourceInterface
    {
        $this->handleValidation($input);

        /** @var RequestInterface $request */
        $request = $this->environment->getAuth()->decorateRequest($action->createRequest($input));

        return $action->transformResponse($this->environment->getClient()->sendRequest($request));
    }

    /**
     * @param InputInterface $input
     * @throws InputValidationFailedException
     */
    protected function handleValidation(InputInterface $input): void
    {
        $violations = $this->validator->validate($input);

        if (count($violations) === 0) {
            return;
        }

        $e = new InputValidationFailedException((string) $violations);
        $e->setInput($input);
        $e->setViolations($violations);

        throw $e;
    }
}
