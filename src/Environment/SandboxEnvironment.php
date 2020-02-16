<?php

namespace StevanPavlovic\HttpConnect\Environment;

final class SandboxEnvironment extends Environment
{
    /** @var string */
    public const KEY = 'sandbox';

    /**
     * @inheritDoc
     */
    public function getKey(): string
    {
        return self::KEY;
    }
}
