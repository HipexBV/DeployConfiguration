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

        //parent::__construct('varnish', '');
    }

    /**
     * @return string
     */
    public function getSupervisorCommand()
    {
        //@todo move to deploy image
        return implode(' ', array_merge([
            'varnishd',
            '-p feature=+esi_ignore_other_elements',
            '-p vcc_allow_inline_c=on',
            '-a :' . $this->frontendPort,
            '-T localhost:' . $this->backendPort,
            '-f {{domain_path}}/var/etc/varnish.vcl',
            '-S {{domain_path}}/var/etc/varnish.secret',
            '-s malloc,' . $this->memory,
            '-F',
            '-n {{domain_path}}/var/run',
        ], $this->arguments));
    }

    /**
     * @return string
     */
    public function getConfigFile(): string
    {
        return $this->configFile;
    }
}
