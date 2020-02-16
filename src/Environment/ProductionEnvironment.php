<?php

namespace StevanPavlovic\HttpConnect\Environment;

final class ProductionEnvironment extends Environment
{
    /** @var string */
    public const KEY = 'production';

    /**
     * @inheritDoc
     */
    public function getKey(): string
    {
        return self::KEY;
    }
}
