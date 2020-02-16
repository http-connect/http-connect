<?php

namespace StevanPavlovic\HttpConnect\Transport;

use StevanPavlovic\HttpConnect\Transport\Traits\HasNoValidation;
use StevanPavlovic\HttpConnect\Transport\Traits\StringifiesAsJson;

final class AnonymousInput implements InputInterface
{
    use HasNoValidation;
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
}
