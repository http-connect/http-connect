<?php

declare(strict_types=1);

namespace HttpConnect\HttpConnect\Action\Traits;

trait Anonymous
{
    /**
     * @return string|null
     */
    final public function getName(): ?string
    {
        return null;
    }
}
