<?php

namespace StevanPavlovic\HttpConnect\Example\TronaldDump;

use StevanPavlovic\HttpConnect\Action\ActionPack;
use StevanPavlovic\HttpConnect\Auth\NoAuth;
use StevanPavlovic\HttpConnect\Environment\ProductionEnvironment;
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

        $environment = new ProductionEnvironment(new NoAuth(), self::BASE_URI);

        parent::__construct($actionPack, $environment);
    }
}
