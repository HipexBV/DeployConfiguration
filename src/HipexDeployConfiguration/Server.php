<?php
/**
 * @author Hipex <info@hipex.io>
 * @copyright (c) Hipex B.V. ${year}
 */

namespace HipexDeployConfiguration;

class Server
{
    /**
     * @var string
     */
    private $hostname;

    /**
     * @var string
     */
    private $role;

    /**
     * Server constructor.
     *
     * @param string $hostname
     * @param string|null $role
     */
    public function __construct(string $hostname, string $role = null)
    {
        $this->hostname = $hostname;
        $this->role = $role;
    }

    /**
     * @return string
     */
    public function getHostname(): string
    {
        return $this->hostname;
    }

    /**
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }
}
