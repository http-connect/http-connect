<?php

namespace HttpConnect\HttpConnect\Example\OpenUV\Uv\Transport;

use HttpConnect\HttpConnect\Transport\ResourceInterface;
use HttpConnect\HttpConnect\Transport\Traits\StringifiesAsJson;

final class UvIndexSunInfoResource implements ResourceInterface
{
    use StringifiesAsJson;

    /**
     * @var UvIndexSunTimesResource
     */
    private $sunTimes;

    /**
     * @var UvIndexSunPositionResource
     */
    private $sunPosition;

    /**
     * @param UvIndexSunTimesResource $sunTimes
     * @param UvIndexSunPositionResource $sunPosition
     */
    public function __construct(UvIndexSunTimesResource $sunTimes, UvIndexSunPositionResource $sunPosition)
    {
        $this->sunTimes = $sunTimes;
        $this->sunPosition = $sunPosition;
    }

    /**
     * @return UvIndexSunTimesResource
     */
    public function getSunTimes(): UvIndexSunTimesResource
    {
        return $this->sunTimes;
    }

    /**
     * @return UvIndexSunPositionResource
     */
    public function getSunPosition(): UvIndexSunPositionResource
    {
        return $this->sunPosition;
    }
}
