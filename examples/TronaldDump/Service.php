<?php

namespace StevanPavlovic\HttpConnect\Example\TronaldDump;

use StevanPavlovic\HttpConnect\Action\ActionPack;
use StevanPavlovic\HttpConnect\Auth\NoAuth;
use StevanPavlovic\HttpConnect\Config\Repository as Config;
use StevanPavlovic\HttpConnect\Environment\Environment;
use StevanPavlovic\HttpConnect\Example\TronaldDump\Quote\Action\GetRandomQuote;
use StevanPavlovic\HttpConnect\Service as ConnectService;

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
