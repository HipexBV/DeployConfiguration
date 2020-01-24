<?php
/**
 * @author Hipex <info@hipex.io>
 * @copyright (c) Hipex B.V. 2020
 */

namespace HipexDeployConfiguration\PlatformService;

use HipexDeployConfiguration\ServerRole;
use HipexDeployConfiguration\ServerRoleConfigurableInterface;
use HipexDeployConfiguration\ServerRoleConfigurableTrait;
use HipexDeployConfiguration\StageConfigurableInterface;
use HipexDeployConfiguration\StageConfigurableTrait;
use HipexDeployConfiguration\TaskConfigurationInterface;

class RedisService implements TaskConfigurationInterface, ServerRoleConfigurableInterface, StageConfigurableInterface
{
    use ServerRoleConfigurableTrait;

    use StageConfigurableTrait;

    /**
     * Defaults
     */
    const DEFAULT_MEMORY = '1024m';

    /**
     * @var string
     */
    private $maxMemory = self::DEFAULT_MEMORY;

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
     * @param string $identifier
     */
    public function __construct(string $identifier = 'backend')
    {
        $this->identifier = $identifier;
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
     * @param string $maxMemory
     */
    public function setMaxMemory(string $maxMemory): void
    {
        $this->maxMemory = $maxMemory;
    }

    /**
     * @return array
     */
    public function getConfigIncludes(): array
    {
        return $this->configIncludes;
    }

    /**
     * @param array $configIncludes
     */
    public function setConfigIncludes(array $configIncludes): void
    {
        $this->configIncludes = $configIncludes;
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
