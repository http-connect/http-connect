<?php

declare(strict_types=1);

namespace HttpConnect\HttpConnect\Auth;

use Psr\Http\Message\RequestInterface;

interface AuthInterface
{
    /**
     * @param RequestInterface $request
     * @return void
     */
    public function decorateRequest(RequestInterface $request): RequestInterface;
}
