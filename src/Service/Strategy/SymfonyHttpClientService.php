<?php

namespace HttpConnect\HttpConnect\Service\Strategy;

use HttpConnect\HttpConnect\Config\RepositoryInterface;
use HttpConnect\HttpConnect\Service\Service;
use HttpConnect\HttpConnect\Service\Strategy\Traits\FactoryMethods;
use HttpConnect\HttpConnect\Service\Strategy\Traits\RequirementChecker;
use Psr\Http\Client\ClientInterface;
use Symfony\Component\HttpClient\CurlHttpClient;
use Symfony\Component\HttpClient\Psr18Client;

class SymfonyHttpClientService extends Service implements StrategyInterface
{
    use RequirementChecker;
    use FactoryMethods;

    /**
     * @return RequirementInterface[]
     */
    public function getRequirements(): array
    {
        return [
            new DependencyRequirement('symfony/http-client'),
            new DependencyRequirement('nyholm/psr7'),
            new DependencyRequirement('monolog/monolog'),
        ];
    }

    /**
     * @param RepositoryInterface $config
     * @return ClientInterface
     */
    public static function createClient(RepositoryInterface $config): ClientInterface
    {
        return new Psr18Client(
            new CurlHttpClient([
                'base_uri' => $config->get('baseUri'),
            ])
        );
    }
}
