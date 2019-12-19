<?php
/**
 * @author Hipex <info@hipex.io>
 * @copyright (c) Hipex B.V. 2018
 */

namespace HipexDeployConfiguration;

/**
 * Contains information per deploy server.
 */
class Server
{
    /**
     * @var string
     */
    private $hostname;

    /**
     * @var string[]
     */
    private $roles;

    /**
     * @var string[]
     */
    private $options = [];

    /**
     * Server constructor.
     *
     * @param string $hostname
     * @param string[] $roles
     */
    public function __construct(string $hostname, array $roles = null, array $options = [])
    {
        $this->hostname = $hostname;
        $this->roles = $roles ?: ServerRole::getValues();
        $this->options = $options;
    }

    /**
     * @return string
     */
    public function getHostname(): string
    {
        return $this->hostname;
    }

    /**
     * @return string[]
     */
    public function getRoles(): array
    {
        return $this->roles;
    }

    /**
     * @return string[]
     */
    public function getOptions(): array
    {
        return $this->options;
    }
}

