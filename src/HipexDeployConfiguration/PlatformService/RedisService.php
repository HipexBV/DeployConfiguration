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
    const DEFAULT_LISTEN = '{{domain_path}}var/run/redis.sock';

    /**
     * @var string
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
    private $redisConfiguration;

    /**
     * @var string
     */
    private $identifier;

    /**
     * @param string   $maxMemory
     * @param string   $listen
     * @param string   $master
     * @param string   $identifier
     * @param string[] $redisConfiguration
     */
    public function __construct(
        string $maxMemory = self::DEFAULT_MEMORY,
        string $listen = self::DEFAULT_LISTEN,
        string $master = null,
        string $identifier = 'backend',
        array $redisConfiguration = []
    ) {
        $this->maxMemory = $maxMemory;
        $this->listen = $listen;
        $this->master = $master;
        $this->redisConfiguration = $redisConfiguration;
        $this->identifier = $identifier;

        $this->setServerRoles([ServerRole::REDIS]);
        $this->setWorkingDirectory(sprintf('{{redis/%s/directory}}', $this->identifier));

        /*parent::__construct(
            'redis-' . $identifier,
            "logrun redis-${identifier} redis-server -c {{redis/${identifier}/config-file}}",
            1,
            [
                'stdout_logfile' => "{{redis/${identifier}/log-file}}",
                'redirect_stderr' => 'true',
                'stdout_logfile_maxbytes' => '50MB',
            ]
        );*/
    }

    /**
     * @return string
     */
    public function getMaxMemory(): string
    {
        return $this->maxMemory;
    }

    /**
     * @return string
     */
    public function getListen(): string
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
    public function getMaster(): ?string
    {
        return $this->master;
    }

    /**
     * @return array
     */
    public function getRedisConfiguration(): array
    {
        return $this->redisConfiguration;
    }

    /**
     * @return string
     */
    public function getIdentifier(): string
    {
        return $this->identifier;
    }
}
