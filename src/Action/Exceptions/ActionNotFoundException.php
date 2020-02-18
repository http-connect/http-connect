<?php

namespace HttpConnect\HttpConnect\Action\Exceptions;

use Exception;
use Psr\Container\NotFoundExceptionInterface;

class ActionNotFoundException extends Exception implements NotFoundExceptionInterface
{
}
