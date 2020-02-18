<?php

namespace StevanPavlovic\HttpConnect\Config;

use Psr\Container\ContainerInterface;
use StevanPavlovic\HttpConnect\Config\Exceptions\PropertyNotFoundException;

class Repository implements ContainerInterface
{
    /**
     * @var array
     */
    private $config;

    /**
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * @inheritDoc
     */
    public function get($id)
    {
        if (!$this->has($id)) {
            $configClass = self::class;

            throw new PropertyNotFoundException(
                "Property {$id} not found in {$configClass}."
            );
        }

        return $this->config[$id];
    }

    /**
     * @inheritDoc
     */
    public function has($id): bool
    {
        return array_key_exists($id, $this->config);
    }
}
