<?php

declare(strict_types=1);

namespace HttpConnect\HttpConnect\Service\Traits;

use HttpConnect\Standard\InputInterface;
use HttpConnect\Standard\ResourceInterface;
use HttpConnect\Standard\Validation\Exceptions\MetadataValidationFailedException;
use HttpConnect\Standard\ActionInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Client\ClientExceptionInterface;

trait KeyCall
{
    use ActionCall;

    /**
     * @var ContainerInterface
     */
    protected $actionPack;

    /**
     * @param string $key
     * @param InputInterface $input
     * @return ResourceInterface
     * @throws MetadataValidationFailedException
     * @throws ClientExceptionInterface
     */
    public function call(string $key, InputInterface $input): ResourceInterface
    {
        /** @var ActionInterface $action */
        $action = $this->actionPack->get($key);

        return $this->callAction($action, $input);
    }
}
