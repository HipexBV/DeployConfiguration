<?php
/**
 * @author Hipex <info@hipex.io>
 * @copyright (c) Hipex B.V. ${year}
 */

namespace HipexDeployConfiguration;

class Stage
{
    /**
     * @var string
     */
    private $domain;

    /**
     * @var Server[]
     */
    private $servers = [];

    /**
     * Stage constructor.
     *
     * @param string $domain
     */
    public function __construct(string $domain)
    {
        $this->domain = $domain;
    }

    /**
     * @param string $hostname
     * @param string $role
     * @return $this
     */
    public function addServer(string $hostname, string $role): Server
    {
        $server = new Server($hostname, $role);
        $this->servers[] = $server;
        return $server;
    }
}
