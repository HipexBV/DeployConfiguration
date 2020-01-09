<?php
/**
 * @author Emico <info@emico.nl>
 * @copyright (c) Emico B.V. 2019
 */
declare(strict_types = 1);

namespace HipexDeployConfiguration\Command\Deploy;

use HipexDeployConfiguration\ServerRole;
use HipexDeployConfiguration\ServerRoleConfigurableInterface;
use HipexDeployConfiguration\ServerRoleConfigurableTrait;

class RedisService implements PlatformServiceInterface, ServerRoleConfigurableInterface
{
    use ServerRoleConfigurableTrait;

    /**
     * Defaults
     */
    const DEFAULT_MEMORY = '1024m';

    /**
     * @var string
     */
    private $maxMemory;

    /**
     * @var int
     */
    private $snapshotSaveFrequency = 60;

    /**
     * @var array
     */
    private $configIncludes;

    /**
     * @var string
     */
    private $identifier;

    /**
     * @param string   $identifier
     * @param string   $maxMemory
     * @param string[] $configIncludes
     */
    public function __construct(
        string $identifier = 'backend',
        string $maxMemory = self::DEFAULT_MEMORY,
        array $configIncludes = []
    ) {
        $this->maxMemory = $maxMemory;
        $this->identifier = $identifier;
        $this->configIncludes = $configIncludes;

        $this->setServerRoles([ServerRole::REDIS]);
    }

    /**
     * @return string
     */
    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    /**
     * @return string
     */
    public function getMaxMemory(): string
    {
        return $this->maxMemory;
    }

    /**
     * @return array
     */
    public function getConfigIncludes(): array
    {
        return $this->configIncludes;
    }

    /**
     * @return int
     */
    public function getSnapshotSaveFrequency(): int
    {
        return $this->snapshotSaveFrequency;
    }

    /**
     * @param int $snapshotSaveFrequency
     */
    public function setSnapshotSaveFrequency(int $snapshotSaveFrequency): void
    {
        $this->snapshotSaveFrequency = $snapshotSaveFrequency;
    }
}
