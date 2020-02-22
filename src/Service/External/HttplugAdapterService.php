<?php

namespace HttpConnect\HttpConnect\Service\External;

use Http\Client\Common\Plugin\LoggerPlugin;
use Http\Client\Common\PluginClient;
use HttpConnect\HttpConnect\Config\RepositoryInterface;
use HttpConnect\HttpConnect\Service\Service;
use HttpConnect\HttpConnect\Service\External\Traits\FactoryMethods;
use HttpConnect\HttpConnect\Service\External\Traits\RequirementChecker;
use Psr\Http\Client\ClientInterface;
use Symfony\Component\HttpClient\CurlHttpClient;
use Symfony\Component\HttpClient\Psr18Client;

class HttplugAdapterService extends Service implements AdapterInterface
{
    use RequirementChecker;
    use FactoryMethods;

    /**
     * @return RequirementInterface[]
     */
    public function getRequirements(): array
    {
        return [
            new DependencyRequirement('nyholm/psr7'),
            new DependencyRequirement('symfony/http-client'),
            new DependencyRequirement('php-http/logger-plugin'),
            new DependencyRequirement('php-http/discovery'),
            new DependencyRequirement('monolog/monolog'),
        ];
    }

    /**
     * @param RepositoryInterface $config
     * @return ClientInterface
     */
    public static function createClient(RepositoryInterface $config): ClientInterface
    {
        return new PluginClient(
            new Psr18Client(
                new CurlHttpClient([
                    'base_uri' => $config->get('baseUri'),
                ])
            ),
            [
                new LoggerPlugin(static::createLogger($config)),
            ]
        );
    }
}
