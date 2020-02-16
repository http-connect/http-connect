<?php

namespace StevanPavlovic\HttpConnect\Action\Exceptions;

use InvalidArgumentException;
use Psr\Container\ContainerExceptionInterface;

class InvalidActionException extends InvalidArgumentException implements ContainerExceptionInterface
{
}
