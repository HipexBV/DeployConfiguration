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

class RedisTcpService extends RedisService
{
    /**
     * @var int
     */
    protected $port;

    /**
     * @param string $identifier
     * @param int    $port
     */
    public function __construct(string $identifier = 'backend', int $port = 6379)
    {
        parent::__construct($identifier);
        $this->port = $port;
    }

    /**
     * @return int
     */
    public function getPort(): int
    {
        return $this->port;
    }
}