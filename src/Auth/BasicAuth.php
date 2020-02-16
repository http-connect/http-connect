<?php

namespace StevanPavlovic\HttpConnect\Auth;

use Psr\Http\Message\RequestInterface;

class BasicAuth implements AuthInterface
{
    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @param string $username
     * @param string $password
     */
    public function __construct(string $username, string $password = '')
    {
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * @inheritDoc
     */
    public function decorateRequest(RequestInterface $request): RequestInterface
    {
        $value = 'Basic ' . base64_encode($this->username . (
            $this->password !== ''
                ? ':' . $this->password
                : ''
        ));

        return $request->withHeader('authorization', $value);
    }
}
