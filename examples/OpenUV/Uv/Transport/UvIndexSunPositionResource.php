<?php

namespace HttpConnect\HttpConnect\Example\OpenUV\Uv\Transport;

use HttpConnect\HttpConnect\Transport\ResourceInterface;
use HttpConnect\HttpConnect\Transport\Traits\StringifiesAsJson;

final class UvIndexSunPositionResource implements ResourceInterface
{
    use StringifiesAsJson;

    /**
     * @var float
     */
    private $azimuth;

    /**
     * @var float
     */
    private $altitude;

    /**
     * @param float $azimuth
     * @param float $altitude
     */
    public function __construct(float $azimuth, float $altitude)
    {
        $this->azimuth = $azimuth;
        $this->altitude = $altitude;
    }

    /**
     * @return float
     */
    public function getAzimuth(): float
    {
        return $this->azimuth;
    }

    /**
     * @return float
     */
    public function getAltitude(): float
    {
        return $this->altitude;
    }
}
