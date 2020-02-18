<?php

namespace HttpConnect\HttpConnect\Example\OpenUV\Auth;

use Psr\Http\Message\RequestInterface;
use HttpConnect\HttpConnect\Auth\AuthInterface;

final class TokenAuth implements AuthInterface
{
    /**
     * @var string
     */
    private $token;

    /**
     * @param string $token
     */
    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function decorateRequest(RequestInterface $request): RequestInterface
    {
        return $request->withHeader('X-Access-Token', $this->token);
    }
}
