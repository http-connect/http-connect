<?php

namespace HttpConnect\HttpConnect\Example\OpenUV\Uv\Transport;

use DateTimeImmutable;
use HttpConnect\HttpConnect\Transport\ResourceInterface;
use HttpConnect\HttpConnect\Transport\Traits\StringifiesAsJson;

final class UvIndexSunTimesResource implements ResourceInterface
{
    use StringifiesAsJson;

    /**
     * @var DateTimeImmutable
     */
    private $solarNoon;

    /**
     * @var DateTimeImmutable
     */
    private $nadir;

    /**
     * @var DateTimeImmutable
     */
    private $sunrise;

    /**
     * @var DateTimeImmutable
     */
    private $sunset;

    /**
     * @var DateTimeImmutable
     */
    private $sunriseEnd;

    /**
     * @var DateTimeImmutable
     */
    private $sunsetStart;

    /**
     * @var DateTimeImmutable
     */
    private $dawn;

    /**
     * @var DateTimeImmutable
     */
    private $dusk;

    /**
     * @var DateTimeImmutable
     */
    private $nauticalDawn;

    /**
     * @var DateTimeImmutable
     */
    private $nauticalDusk;

    /**
     * @var DateTimeImmutable
     */
    private $nightEnd;

    /**
     * @var DateTimeImmutable
     */
    private $night;

    /**
     * @var DateTimeImmutable
     */
    private $goldenHourEnd;

    /**
     * @var DateTimeImmutable
     */
    private $goldenHour;

    /**
     * @param DateTimeImmutable $solarNoon
     * @param DateTimeImmutable $nadir
     * @param DateTimeImmutable $sunrise
     * @param DateTimeImmutable $sunset
     * @param DateTimeImmutable $sunriseEnd
     * @param DateTimeImmutable $sunsetStart
     * @param DateTimeImmutable $dawn
     * @param DateTimeImmutable $dusk
     * @param DateTimeImmutable $nauticalDawn
     * @param DateTimeImmutable $nauticalDusk
     * @param DateTimeImmutable $nightEnd
     * @param DateTimeImmutable $night
     * @param DateTimeImmutable $goldenHourEnd
     * @param DateTimeImmutable $goldenHour
     */
    public function __construct(
        DateTimeImmutable $solarNoon,
        DateTimeImmutable $nadir,
        DateTimeImmutable $sunrise,
        DateTimeImmutable $sunset,
        DateTimeImmutable $sunriseEnd,
        DateTimeImmutable $sunsetStart,
        DateTimeImmutable $dawn,
        DateTimeImmutable $dusk,
        DateTimeImmutable $nauticalDawn,
        DateTimeImmutable $nauticalDusk,
        DateTimeImmutable $nightEnd,
        DateTimeImmutable $night,
        DateTimeImmutable $goldenHourEnd,
        DateTimeImmutable $goldenHour
    ) {
        $this->solarNoon = $solarNoon;
        $this->nadir = $nadir;
        $this->sunrise = $sunrise;
        $this->sunset = $sunset;
        $this->sunriseEnd = $sunriseEnd;
        $this->sunsetStart = $sunsetStart;
        $this->dawn = $dawn;
        $this->dusk = $dusk;
        $this->nauticalDawn = $nauticalDawn;
        $this->nauticalDusk = $nauticalDusk;
        $this->nightEnd = $nightEnd;
        $this->night = $night;
        $this->goldenHourEnd = $goldenHourEnd;
        $this->goldenHour = $goldenHour;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getSolarNoon(): DateTimeImmutable
    {
        return $this->solarNoon;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getNadir(): DateTimeImmutable
    {
        return $this->nadir;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getSunrise(): DateTimeImmutable
    {
        return $this->sunrise;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getSunset(): DateTimeImmutable
    {
        return $this->sunset;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getSunriseEnd(): DateTimeImmutable
    {
        return $this->sunriseEnd;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getSunsetStart(): DateTimeImmutable
    {
        return $this->sunsetStart;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getDawn(): DateTimeImmutable
    {
        return $this->dawn;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getDusk(): DateTimeImmutable
    {
        return $this->dusk;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getNauticalDawn(): DateTimeImmutable
    {
        return $this->nauticalDawn;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getNauticalDusk(): DateTimeImmutable
    {
        return $this->nauticalDusk;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getNightEnd(): DateTimeImmutable
    {
        return $this->nightEnd;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getNight(): DateTimeImmutable
    {
        return $this->night;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getGoldenHourEnd(): DateTimeImmutable
    {
        return $this->goldenHourEnd;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getGoldenHour(): DateTimeImmutable
    {
        return $this->goldenHour;
    }
}
