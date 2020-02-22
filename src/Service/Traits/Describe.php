<?php

namespace HttpConnect\HttpConnect\Service\Traits;

use HttpConnect\HttpConnect\Config\RepositoryInterface;

trait Describe
{
    /**
     * @var string
     */
    protected $id = 'http-connect-service';

    /**
     * @var string
     */
    protected $name = 'HttpConnect Service';

    /**
     * @var string
     */
    protected $description = 'Sample HttpConnect Service.';

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param RepositoryInterface $config
     * @return void
     */
    protected function describeFromConfig(RepositoryInterface $config): void
    {
        $this->name = $config->has('serviceName')
            ? $config->get('serviceName')
            : $this->name;

        $this->name = $config->has('serviceName')
            ? $config->get('serviceName')
            : $this->name;

        $this->description = $config->has('serviceDescription')
            ? $config->get('serviceDescription')
            : $this->description;
    }
}
