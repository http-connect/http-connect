<?php

declare(strict_types=1);

namespace HttpConnect\HttpConnect\Config;

use HttpConnect\HttpConnect\Validation\ValidatorMetadataInterface;
use Psr\Container\ContainerInterface;

interface RepositoryInterface extends ContainerInterface, ValidatorMetadataInterface
{
}
