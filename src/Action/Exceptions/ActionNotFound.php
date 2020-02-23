<?php

declare(strict_types=1);

namespace HttpConnect\HttpConnect\Action\Exceptions;

use Exception;
use Psr\Container\NotFoundExceptionInterface;

class ActionNotFound extends Exception implements NotFoundExceptionInterface
{
}
