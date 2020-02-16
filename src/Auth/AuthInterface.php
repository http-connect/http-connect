<?php

namespace StevanPavlovic\HttpConnect\Auth;

use Psr\Http\Message\RequestInterface;

interface AuthInterface
{
    /**
     * @param RequestInterface $request
     * @return void
     */
    public function decorateRequest(RequestInterface $request): RequestInterface;
}
