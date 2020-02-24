<?php

declare(strict_types=1);

namespace HttpConnect\HttpConnect\Config;

use HttpConnect\HttpConnect\Config\Exceptions\PropertyNotFoundException;
use HttpConnect\HttpConnect\Validation\Traits\DefinesSinglePropertyValidation;
use HttpConnect\HttpConnect\Validation\Traits\HandlesMetadataValidation;
use HttpConnect\Standard\Config\RepositoryInterface;
use HttpConnect\Standard\Validation\Exceptions\MetadataValidationFailedException;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints as Assert;

class Config implements RepositoryInterface
{
    use HandlesMetadataValidation;
    use DefinesSinglePropertyValidation;

    /**
     * @var string
     */
    protected static $validatedPropertyName = 'config';

    /**
     * @var array
     */
    private $config;

    /**
     * @param array $config
     * @throws MetadataValidationFailedException
     */
    public function __construct(array $config)
    {
        $this->config = $config;
        $this->handleMetadataValidation($this);
    }

    /**
     * @inheritDoc
     */
    final public function get($id)
    {
        if (!$this->has($id)) {
            $configClass = self::class;

            throw new PropertyNotFoundException(
                "Property {$id} not found in `{$configClass}` configuration values."
            );
        }

        return $this->config[$id];
    }

    /**
     * @inheritDoc
     */
    final public function has($id): bool
    {
        return array_key_exists($id, $this->config);
    }

    /**
     * @return Constraint[]
     */
    protected static function getValidatorConstraints(): array
    {
        return [
            new Assert\NotBlank(),
            new Assert\Collection([
                'baseUri' => [
                    new Assert\NotBlank(),
                    new Assert\Url(),
                ],
                'serviceId' => [
                    new Assert\Type('string'),
                ],
                'serviceName' => [
                    new Assert\Type('string'),
                ],
                'serviceDescription' => [
                    new Assert\Type('string'),
                ],
                'logFilePath' => [
                    new Assert\NotBlank(),
                    new Assert\Type('string'),
                ],
            ]),
        ];
    }
}
