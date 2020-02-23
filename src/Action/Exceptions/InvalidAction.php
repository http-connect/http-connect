<?php

declare(strict_types=1);

namespace HttpConnect\HttpConnect\Action\Exceptions;

use InvalidArgumentException;
use Psr\Container\ContainerExceptionInterface;

class InvalidAction extends InvalidArgumentException implements ContainerExceptionInterface
{
}
