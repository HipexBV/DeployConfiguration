<?php
/**
 * @author Emico <info@emico.nl>
 * @copyright (c) Emico B.V. 2019
 */
declare(strict_types = 1);

namespace HipexDeployConfiguration\Command\Deploy;

use HipexDeployConfiguration\DeployCommand;
use HipexDeployConfiguration\ServerRole;

class VarnishConfiguration extends DeployCommand
{
    /**
     * Defaults
     */
    const DEFAULT_FRONTEND_PORT = 6181;
    const DEFAULT_BACKEND_PORT = 6182;
    const DEFAULT_MEMORY = '1024m';
    const DEFAULT_CONFIG_FILE = 'etc/varnish.vcl';

    /**
     * @var string
     */
    private $memory;

    /**
     * @var int
     */
    private $frontendPort;

    /**
     * @var int
     */
    private $backendPort;

    /**
     * @var array|string[]
     */
    private $arguments;

    /**
     * @var string
     */
    private $configFile;

    /**
     * @param string   $memory
     * @param int      $frontendPort
     * @param int      $backendPort
     * @param string   $configFile
     * @param string[] $configuration
     */
    public function __construct(
        $memory = self::DEFAULT_MEMORY,
        $frontendPort = self::DEFAULT_FRONTEND_PORT,
        $backendPort = self::DEFAULT_BACKEND_PORT,
        $configFile = self::DEFAULT_CONFIG_FILE,
        $configuration = []
    ) {
        $this->memory = $memory;
        $this->frontendPort = $frontendPort;
        $this->backendPort = $backendPort;
        $this->arguments = $configuration;
        $this->configFile = $configFile;
        $this->setServerRoles([ServerRole::VARNISH]);
        parent::__construct();
    }

    /**
     * @return int
     */
    public function getMemory()
    {
        return $this->memory;
    }

    /**
     * @return int
     */
    public function getFrontendPort()
    {
        return $this->frontendPort;
    }

    /**
     * @return int
     */
    public function getBackendPort()
    {
        return $this->backendPort;
    }

    /**
     * @return string
     */
    public function getConfigFile()
    {
        return $this->configFile;
    }

    /**
     * @return string[]
     */
    public function getArguments()
    {
        return $this->arguments;
    }
}
