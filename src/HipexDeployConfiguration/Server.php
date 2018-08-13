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
     * Server constructor.
     *
     * @param string $hostname
     * @param string[] $roles
     */
    public function __construct(string $hostname, array $roles = null)
    {
        $this->hostname = $hostname;
        $this->roles = $roles ?: ServerRole::getValues();
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
}
