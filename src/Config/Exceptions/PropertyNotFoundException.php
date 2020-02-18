<?php

namespace StevanPavlovic\HttpConnect\Config\Exceptions;

use InvalidArgumentException;
use Psr\Container\NotFoundExceptionInterface;

class PropertyNotFoundException extends InvalidArgumentException implements NotFoundExceptionInterface
{
}
