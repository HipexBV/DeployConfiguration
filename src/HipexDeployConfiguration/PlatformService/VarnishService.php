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

class VarnishService implements PlatformServiceInterface, ServerRoleConfigurableInterface
{
    use ServerRoleConfigurableTrait;

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
     * @var string
     */
    private $configFile;

    /**
     * @param string   $memory
     * @param int      $frontendPort
     * @param int      $backendPort
     * @param string   $configFile
     */
    public function __construct(
        $memory = self::DEFAULT_MEMORY,
        $frontendPort = self::DEFAULT_FRONTEND_PORT,
        $backendPort = self::DEFAULT_BACKEND_PORT,
        $configFile = self::DEFAULT_CONFIG_FILE
    ) {
        $this->memory = $memory;
        $this->frontendPort = $frontendPort;
        $this->backendPort = $backendPort;
        $this->configFile = $configFile;

        $this->setServerRoles([ServerRole::VARNISH]);
    }

    /**
     * @return string
     */
    public function getConfigFile(): string
    {
        return $this->configFile;
    }
}
