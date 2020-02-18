<?php

namespace HttpConnect\HttpConnect\Example\OpenUV\Uv\Transport;

use DateTimeImmutable;
use HttpConnect\HttpConnect\Transport\ResourceInterface;
use HttpConnect\HttpConnect\Transport\Traits\StringifiesAsJson;

final class UvIndexResource implements ResourceInterface
{
    use StringifiesAsJson;

    /**
     * @var float
     */
    private $uv;

    /**
     * @var DateTimeImmutable
     */
    private $uvTime;

    /**
     * @var float
     */
    private $uvMax;

    /**
     * @var DateTimeImmutable
     */
    private $uvMaxTime;

    /**
     * @var float
     */
    private $ozone;

    /**
     * @var DateTimeImmutable
     */
    private $ozoneTime;

    /**
     * @var array
     */
    private $saveExposureTime;

    /**
     * @var UvIndexSunInfoResource
     */
    private $sunInfo;

    /**
     * @param float $uv
     * @param DateTimeImmutable $uvTime
     * @param float $uvMax
     * @param DateTimeImmutable $uvMaxTime
     * @param float $ozone
     * @param DateTimeImmutable $ozoneTime
     * @param array $saveExposureTime
     * @param UvIndexSunInfoResource $sunInfo
     */
    public function __construct(
        float $uv,
        DateTimeImmutable $uvTime,
        float $uvMax,
        DateTimeImmutable $uvMaxTime,
        float $ozone,
        DateTimeImmutable $ozoneTime,
        array $saveExposureTime,
        UvIndexSunInfoResource $sunInfo
    ) {
        $this->uv = $uv;
        $this->uvTime = $uvTime;
        $this->uvMax = $uvMax;
        $this->uvMaxTime = $uvMaxTime;
        $this->ozone = $ozone;
        $this->ozoneTime = $ozoneTime;
        $this->saveExposureTime = $saveExposureTime;
        $this->sunInfo = $sunInfo;
    }

    /**
     * @return float
     */
    public function getUv(): float
    {
        return $this->uv;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getUvTime(): DateTimeImmutable
    {
        return $this->uvTime;
    }

    /**
     * @return float
     */
    public function getUvMax(): float
    {
        return $this->uvMax;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getUvMaxTime(): DateTimeImmutable
    {
        return $this->uvMaxTime;
    }

    /**
     * @return float
     */
    public function getOzone(): float
    {
        return $this->ozone;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getOzoneTime(): DateTimeImmutable
    {
        return $this->ozoneTime;
    }

    /**
     * @return array
     */
    public function getSaveExposureTime(): array
    {
        return $this->saveExposureTime;
    }

    /**
     * @return UvIndexSunInfoResource
     */
    public function getSunInfo(): UvIndexSunInfoResource
    {
        return $this->sunInfo;
    }
}
