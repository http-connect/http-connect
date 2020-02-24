<?php

declare(strict_types=1);

namespace HttpConnect\HttpConnect\Service\External;

use HttpConnect\Standard\Config\RepositoryInterface;
use HttpConnect\HttpConnect\Service\Service;
use HttpConnect\HttpConnect\Service\External\Traits\FactoryMethods;
use HttpConnect\HttpConnect\Service\External\Traits\RequirementChecker;
use Psr\Http\Client\ClientInterface;
use Symfony\Component\HttpClient\CurlHttpClient;
use Symfony\Component\HttpClient\Psr18Client;

class SymfonyHttpClientAdapterService extends Service implements AdapterInterface
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
