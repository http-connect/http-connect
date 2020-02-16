<?php

namespace StevanPavlovic\HttpConnect\Transport;

use ArrayAccess;
use BadMethodCallException;
use OutOfBoundsException;
use StevanPavlovic\HttpConnect\Transport\Traits\StringifiesAsJson;

final class AnonymousResource implements ResourceInterface, ArrayAccess
{
    use StringifiesAsJson;

    /**
     * @var array
     */
    private $data;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @inheritDoc
     */
    public function offsetExists($offset): bool
    {
        return array_key_exists($offset, $this->getData());
    }

    /**
     * @inheritDoc
     * @throws OutOfBoundsException
     */
    public function offsetGet($offset)
    {
        if (!$this->offsetExists($offset)) {
            throw new OutOfBoundsException("Offset \"{$offset}\" does not exist in this resource.");
        }

        return $this->getData()[$offset];
    }

    /**
     * @inheritDoc
     * @throws BadMethodCallException
     */
    public function offsetSet($offset, $value): void
    {
        throw new BadMethodCallException('Setting data to instantiated resource is not allowed.');
    }

    /**
     * @inheritDoc
     * @throws BadMethodCallException
     */
    public function offsetUnset($offset): void
    {
        throw new BadMethodCallException('Unetting data from instantiated resource is not allowed.');
    }
}
