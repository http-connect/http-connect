<?php

namespace HttpConnect\HttpConnect\Example\OpenUV\Uv\Transport;

use DateTimeInterface;
use HttpConnect\HttpConnect\Transport\InputInterface;
use HttpConnect\HttpConnect\Transport\Traits\StringifiesAsJson;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

final class UvIndexInput implements InputInterface
{
    use StringifiesAsJson;

    /**
     * @var float
     */
    private $lat;

    /**
     * @var float
     */
    private $lng;

    /**
     * @var int
     */
    private $alt;

    /**
     * @var int
     */
    private $ozone;

    /**
     * @var DateTimeInterface
     */
    private $dt;

    /**
     * @param float $lat
     * @param float $lng
     * @param int $alt
     * @param int $ozone
     * @param DateTimeInterface $dt
     */
    public function __construct(
        float $lat,
        float $lng,
        int $alt,
        int $ozone,
        DateTimeInterface $dt
    ) {
        $this->lat = $lat;
        $this->lng = $lng;
        $this->alt = $alt;
        $this->ozone = $ozone;
        $this->dt = $dt;
    }

    /**
     * @return float
     */
    public function getLat(): float
    {
        return $this->lat;
    }

    /**
     * @return float
     */
    public function getLng(): float
    {
        return $this->lng;
    }

    /**
     * @return int
     */
    public function getAlt(): int
    {
        return $this->alt;
    }

    /**
     * @return int
     */
    public function getOzone(): int
    {
        return $this->ozone;
    }

    /**
     * @return DateTimeInterface
     */
    public function getDt(): DateTimeInterface
    {
        return $this->dt;
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata): void
    {
        $metadata->addPropertyConstraints('lat', [
            new Assert\NotBlank(),
            new Assert\Type([
                'type' => 'float',
            ]),
            new Assert\Range([
                'min' => -90.0,
            ]),
            new Assert\Range([
                'min' => 90.0,
            ]),
        ]);

        $metadata->addPropertyConstraints('lng', [
            new Assert\NotBlank(),
            new Assert\Type([
                'type' => 'float',
            ]),
            new Assert\Range([
                'min' => -180.0,
            ]),
            new Assert\Range([
                'min' => 180.0,
            ]),
        ]);

        $metadata->addPropertyConstraints('alt', [
            new Assert\Type([
                'type' => 'integer',
            ]),
            new Assert\Range([
                'min' => 0,
                'max' => 10000,
            ]),
        ]);

        $metadata->addPropertyConstraints('ozone', [
            new Assert\Type([
                'type' => 'integer',
            ]),
            new Assert\Range([
                'min' => 100,
                'max' => 550,
            ]),
        ]);
    }
}
