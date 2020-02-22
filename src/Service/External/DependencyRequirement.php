<?php

namespace HttpConnect\HttpConnect\Service\External;

use Composer\Semver\Semver;
use OutOfBoundsException;
use PackageVersions\Versions;

class DependencyRequirement implements RequirementInterface
{
    /**
     * @var string
     */
    private $packageName;
    /**
     * @var string|null
     */
    private $versionConstraints;

    /**
     * @param string $packageName
     * @param string|null $versionConstraints
     */
    public function __construct(
        string $packageName,
        ?string $versionConstraints = null
    ) {
        $this->packageName = $packageName;
        $this->versionConstraints = $versionConstraints;
    }

    /**
     * @inheritDoc
     */
    public function isMet(): bool
    {
        try {
            $currentVersion = Versions::getVersion($this->packageName);
        } catch (OutOfBoundsException $e) {
            return false;
        }

        return $this->versionConstraints === null
            || Semver::satisfies($currentVersion, $this->versionConstraints);
    }

    /**
     * @inheritDoc
     */
    public function getSolution(): string
    {
        $versionPart = $this->versionConstraints
            ? " or its version does not satisfy `{$this->versionConstraints}`"
            : '';

        return "Dependency `{$this->packageName}` is not installed{$versionPart}.";
    }
}
