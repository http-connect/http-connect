<?php

namespace HttpConnect\HttpConnect\Example\OpenUV\Uv\Action;

use DateTimeImmutable;
use DateTimeInterface;
use Exception;
use InvalidArgumentException;
use Nyholm\Psr7\Uri;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;
use Rize\UriTemplate;
use HttpConnect\HttpConnect\Action\Action;
use HttpConnect\HttpConnect\Example\OpenUV\Uv\Transport\UvIndexInput;
use HttpConnect\HttpConnect\Example\OpenUV\Uv\Transport\UvIndexResource;
use HttpConnect\HttpConnect\Example\OpenUV\Uv\Transport\UvIndexSunInfoResource;
use HttpConnect\HttpConnect\Example\OpenUV\Uv\Transport\UvIndexSunPositionResource;
use HttpConnect\HttpConnect\Example\OpenUV\Uv\Transport\UvIndexSunTimesResource;
use HttpConnect\HttpConnect\Transport\InputInterface;
use HttpConnect\HttpConnect\Transport\ResourceInterface;

final class GetUvIndex extends Action
{
    /**
     * @inheritDoc
     */
    protected function getMethod(): string
    {
        return static::GET;
    }

    /**
     * @inheritDoc
     */
    protected function createUri(InputInterface $input): UriInterface
    {
        if (!$input instanceof UvIndexInput) {
            throw new InvalidArgumentException(
                'Expected ' . UvIndexInput::class . ' but got ' . get_class($input) . '.'
            );
        }

        return new Uri((new UriTemplate())->expand(
            'uv{?lat,lng,alt,ozone,dt}',
            [
                'lat' => $input->getLat(),
                'lng' => $input->getLng(),
                'alt' => $input->getAlt(),
                'ozone' => $input->getOzone(),
                'dt' => $input->getDt()->format(DateTimeInterface::RFC3339_EXTENDED),
            ]
        ));
    }

    /**
     * @inheritDoc
     * @return UvIndexResource
     * @throws Exception
     */
    public function transformResponse(ResponseInterface $response): ResourceInterface
    {
        $data = json_decode(
            $response->getBody()->getContents(),
            true,
            512,
            JSON_THROW_ON_ERROR
        )['result'];

        return new UvIndexResource(
            $data['uv'],
            new DateTimeImmutable($data['uv_time']),
            $data['uv_max'],
            new DateTimeImmutable($data['uv_max_time']),
            $data['ozone'],
            new DateTimeImmutable($data['ozone_time']),
            $data['safe_exposure_time'],
            new UvIndexSunInfoResource(
                new UvIndexSunTimesResource(
                    $data['sun_info']['sun_times']['solar_noon'],
                    $data['sun_info']['sun_times']['nadir'],
                    $data['sun_info']['sun_times']['sunrise'],
                    $data['sun_info']['sun_times']['sunset'],
                    $data['sun_info']['sun_times']['sunrise_end'],
                    $data['sun_info']['sun_times']['sunset_start'],
                    $data['sun_info']['sun_times']['dawn'],
                    $data['sun_info']['sun_times']['dusk'],
                    $data['sun_info']['sun_times']['nautical_dawn'],
                    $data['sun_info']['sun_times']['nautical_dusk'],
                    $data['sun_info']['sun_times']['night_end'],
                    $data['sun_info']['sun_times']['night'],
                    $data['sun_info']['sun_times']['golden_hour_end'],
                    $data['sun_info']['sun_times']['golden_hour']
                ),
                new UvIndexSunPositionResource(
                    $data['sun_info']['sun_position']['azimuth'],
                    $data['sun_info']['sun_position']['altitude']
                )
            )
        );
    }

    /**
     * @inheritDoc
     */
    public function getName(): ?string
    {
        return 'Real-time UV Index';
    }

    /**
     * @inheritDoc
     */
    public function getDescription(): ?string
    {
        return 'Get real-time UV Index by location. Optional altitude, ozone level and datetime could be provided as query parameters.';
    }
}
