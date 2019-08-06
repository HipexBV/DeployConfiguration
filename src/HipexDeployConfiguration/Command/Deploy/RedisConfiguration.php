<?php
/**
 * @author Emico <info@emico.nl>
 * @copyright (c) Emico B.V. 2019
 */
declare(strict_types = 1);

namespace HipexDeployConfiguration\Command\Deploy;

use HipexDeployConfiguration\DeployCommand;
use HipexDeployConfiguration\ServerRole;

class RedisConfiguration extends DeployCommand
{
    /**
     * Defaults
     */
    const DEFAULT_MEMORY = '1024m';
    const DEFAULT_LISTEN = '{{domain_path}}var/run/redis.sock';

    /**
     * @var int
     */
    private $maxMemory;

    /**
     * @var string
     */
    private $listen;

    /**
     * @var array|string[]
     */
    private $settings;

    /**
     * @var string|null
     */
    private $master;

    /**
     * @var array
     */
    private $configuration;

    /**
     * @param string   $maxMemory
     * @param string   $listen
     * @param null     $master
     * @param string[] $configuration
     */
    public function __construct(
        $maxMemory = self::DEFAULT_MEMORY,
        $listen = self::DEFAULT_LISTEN,
        $master = null,
        $configuration = []
    ) {
        $this->maxMemory = $maxMemory;
        $this->listen = $listen;
        $this->master = $master;
        $this->configuration = $configuration;
        $this->setServerRoles([ServerRole::REDIS]);
        parent::__construct();
    }

    /**
     * @return int
     */
    public function getMaxMemory()
    {
        return $this->maxMemory;
    }

    /**
     * @return string
     */
    public function getListen()
    {
        return $this->listen;
    }

    /**
     * @return array|string[]
     */
    public function getSettings()
    {
        return $this->settings;
    }

    /**
     * @return string|null
     */
    public function getMaster()
    {
        return $this->master;
    }

    /**
     * @return array
     */
    public function getConfiguration()
    {
        return $this->configuration;
    }
}
