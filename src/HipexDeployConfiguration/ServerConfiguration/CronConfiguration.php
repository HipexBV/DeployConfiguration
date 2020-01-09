<?php
/**
 * @author Emico <info@emico.nl>
 * @copyright (c) Emico B.V. 2019
 */
declare(strict_types = 1);

namespace HipexDeployConfiguration\ServerConfiguration;

use HipexDeployConfiguration\ServerRoleConfigurableInterface;
use HipexDeployConfiguration\ServerRoleConfigurableTrait;

class CronConfiguration implements ServerConfigurationInterface, ServerRoleConfigurableInterface
{
    use ServerRoleConfigurableTrait;

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
