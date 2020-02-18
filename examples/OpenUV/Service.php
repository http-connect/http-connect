<?php

namespace HttpConnect\HttpConnect\Example\OpenUV;

use HttpConnect\HttpConnect\Action\ActionPack;
use HttpConnect\HttpConnect\Environment\Environment;
use HttpConnect\HttpConnect\Example\OpenUV\Auth\TokenAuth;
use HttpConnect\HttpConnect\Example\OpenUV\Uv\Action\GetUvIndex;
use HttpConnect\HttpConnect\Service as ConnectService;

class Service extends ConnectService
{
    /** @var string */
    public const BASE_URI = 'https://api.openuv.io/api/v1/';

    /**
     * @param string $token
     */
    public function __construct(string $token)
    {
        parent::__construct(
            new ActionPack([
                new GetUvIndex(),
            ]),
            new Environment(new TokenAuth($token), self::BASE_URI)
        );
    }
}
