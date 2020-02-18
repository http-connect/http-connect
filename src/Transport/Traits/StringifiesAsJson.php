<?php

namespace HttpConnect\HttpConnect\Transport\Traits;

trait StringifiesAsJson
{
    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        /** @var string $string */
        $string = json_encode($this->data, JSON_THROW_ON_ERROR);
        return $string;
    }
}
