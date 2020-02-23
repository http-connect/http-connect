<?php

declare(strict_types=1);

namespace HttpConnect\HttpConnect\Auth;

use Psr\Http\Message\RequestInterface;

final class NoAuth implements AuthInterface
{
    /**
     * @inheritDoc
     */
    public function decorateRequest(RequestInterface $request): RequestInterface
    {
        return $request;
    }
}
