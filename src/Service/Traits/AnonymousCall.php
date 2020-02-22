<?php

namespace HttpConnect\HttpConnect\Service\Traits;

use HttpConnect\HttpConnect\Action\AnonymousAction;
use HttpConnect\HttpConnect\Transport\AnonymousInput;
use HttpConnect\HttpConnect\Transport\ResourceInterface;
use HttpConnect\HttpConnect\Validation\Exceptions\MetadataValidationFailedException;
use Psr\Http\Client\ClientExceptionInterface;

trait AnonymousCall
{
    use ActionCall;

    /**
     * @param AnonymousAction $action
     * @param AnonymousInput|null $input
     * @return ResourceInterface
     * @throws MetadataValidationFailedException
     * @throws ClientExceptionInterface
     */
    public function callAnonymous(AnonymousAction $action, ?AnonymousInput $input = null): ResourceInterface
    {
        return $this->callAction($action, $input ?: new AnonymousInput([]));
    }
}
