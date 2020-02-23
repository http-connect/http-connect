<?php

declare(strict_types=1);

namespace HttpConnect\HttpConnect\Service;

use HttpConnect\HttpConnect\Action\AnonymousAction;
use HttpConnect\HttpConnect\Transport\AnonymousInput;
use HttpConnect\HttpConnect\Transport\AnonymousResource;
use HttpConnect\HttpConnect\Validation\Exceptions\MetadataValidationFailedException;
use HttpConnect\HttpConnect\Transport\InputInterface;
use HttpConnect\HttpConnect\Transport\ResourceInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Client\ClientExceptionInterface;

interface ServiceInterface
{
    /**
     * @return ContainerInterface
     */
    public function getActionPack(): ContainerInterface;

    /**
     * @param string $key
     * @param InputInterface $input
     * @return ResourceInterface
     * @throws ContainerExceptionInterface
     * @throws MetadataValidationFailedException
     * @throws ClientExceptionInterface
     */
    public function call(string $key, InputInterface $input): ResourceInterface;

    /**
     * @param AnonymousAction $action
     * @param AnonymousInput $input
     * @return AnonymousResource
     * @throws ClientExceptionInterface
     * @throws MetadataValidationFailedException
     */
    public function callAnonymous(AnonymousAction $action, ?AnonymousInput $input = null): ResourceInterface;
}
