<?php

declare(strict_types=1);

namespace HttpConnect\HttpConnect\Auth;

use HttpConnect\Standard\AuthInterface;
use Psr\Http\Message\RequestInterface;

class BearerAuth implements AuthInterface
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

    /**
     * @inheritDoc
     */
    public function decorateRequest(RequestInterface $request): RequestInterface
    {
        return $request->withHeader('authorization', 'Bearer ' . $this->token);
    }
}
