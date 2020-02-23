<?php

declare(strict_types=1);

namespace HttpConnect\HttpConnect\Service\External;

use GuzzleHttp\HandlerStack;
use GuzzleHttp\MessageFormatter;
use GuzzleHttp\Middleware;
use HttpConnect\HttpConnect\Environment\Environment;
use HttpConnect\HttpConnect\Environment\EnvironmentInterface;
use HttpConnect\HttpConnect\Validation\Exceptions\MetadataValidationFailedException;
use RicardoFiorani\GuzzlePsr18Adapter\Client as GuzzleClient;
use HttpConnect\HttpConnect\Config\RepositoryInterface;
use HttpConnect\HttpConnect\Service\Service;
use HttpConnect\HttpConnect\Service\External\Traits\FactoryMethods;
use HttpConnect\HttpConnect\Service\External\Traits\RequirementChecker;
use Psr\Http\Client\ClientInterface;

class GuzzleAdapterService extends Service implements AdapterInterface
{
    use RequirementChecker;
    use FactoryMethods;

    /**
     * @return RequirementInterface[]
     */
    public function getRequirements(): array
    {
        return [
            new DependencyRequirement('ricardofiorani/guzzle-psr18-adapter'),
            new DependencyRequirement('monolog/monolog'),
        ];
    }

    /**
     * @param array $rawConfig
     * @return EnvironmentInterface
     * @throws MetadataValidationFailedException
     */
    public static function createEnvironment(array $rawConfig): EnvironmentInterface
    {
        $config = static::createConfig($rawConfig);

        return new Environment(
            static::createAuth($config),
            $config,
            static::createClient($config),
            null
        );
    }

    /**
     * @param RepositoryInterface $config
     * @return ClientInterface
     */
    public static function createClient(RepositoryInterface $config): ClientInterface
    {
        $stack = HandlerStack::create();
        $stack->push(Middleware::log(static::createLogger($config), new MessageFormatter()));

        return new GuzzleClient([
            'base_uri' => $config->get('baseUri'),
            'handler' => $stack,
        ]);
    }
}
