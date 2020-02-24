<?php

declare(strict_types=1);

namespace HttpConnect\HttpConnect\Transport;

use HttpConnect\HttpConnect\Transport\Traits\HasNoValidation;
use HttpConnect\HttpConnect\Transport\Traits\StringifiesAsJson;
use HttpConnect\Standard\InputInterface;

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
