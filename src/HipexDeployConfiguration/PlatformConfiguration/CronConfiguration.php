<?php
/**
 * @author Hipex <info@hipex.io>
 * @copyright (c) Hipex B.V. 2020
 */

namespace HipexDeployConfiguration\PlatformConfiguration;

use HipexDeployConfiguration\ServerRoleConfigurableInterface;
use HipexDeployConfiguration\ServerRoleConfigurableTrait;
use HipexDeployConfiguration\StageConfigurableInterface;
use HipexDeployConfiguration\StageConfigurableTrait;
use HipexDeployConfiguration\TaskConfigurationInterface;

class CronConfiguration implements
    TaskConfigurationInterface,
    ServerRoleConfigurableInterface,
    StageConfigurableInterface
{
    use ServerRoleConfigurableTrait;

    use StageConfigurableTrait;

    /**
     * @var string
     */
    private $sourceFile;

    /**
     * @var string
     */
    private $pathEnvVar = '/usr/local/bin:/usr/bin';

    /**
     * @param string $sourceFile
     */
    public function __construct($sourceFile = 'etc/cron')
    {
        $this->sourceFile = $sourceFile;
    }

    /**
     * @return string
     */
    public function getSourceFile()
    {
        return $this->sourceFile;
    }

    /**
     * @param string $path
     */
    public function setPathEnvironmentVariable(string $path)
    {
        $this->pathEnvVar = $path;
    }

    /**
     * @return string
     */
    public function getPathEnvironmentVariable(): string
    {
        return $this->pathEnvVar;
    }
}
