<?php

namespace HttpConnect\HttpConnect\Example\TronaldDump;

use HttpConnect\HttpConnect\Action\ActionPack;
use HttpConnect\HttpConnect\Auth\NoAuth;
use HttpConnect\HttpConnect\Config\Repository as Config;
use HttpConnect\HttpConnect\Environment\Environment;
use HttpConnect\HttpConnect\Example\TronaldDump\Quote\Action\GetRandomQuote;
use HttpConnect\HttpConnect\Service as ConnectService;

class Service extends ConnectService
{
    /** @var string */
    public const BASE_URI = 'https://api.tronalddump.io/';

    public function __construct()
    {
        $actionPack = new ActionPack([
            new GetRandomQuote(),
        ]);

        $environment = new Environment(new NoAuth(), new Config([
            'base_uri' => self::BASE_URI,
        ]));

        parent::__construct($actionPack, $environment);
    }
}
