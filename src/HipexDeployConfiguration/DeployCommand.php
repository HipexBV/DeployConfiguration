<?php
/**
 * @author Hipex <info@hipex.io>
 * @copyright (c) Hipex B.V. ${year}
 */

namespace HipexDeployConfiguration;

class DeployCommand extends Command
{
    /**
     * When set the command is only run on servers with one of the provided roles.
     *
     * @var string[]
     */
    private $serverRoles = [];

    /**
     * @return string[]
     */
    public function getServerRoles(): array
    {
        return $this->serverRoles;
    }

    /**
     * @param string[] $serverRoles
     * @return $this
     */
    public function setServerRoles(array $serverRoles): self
    {
        $this->serverRoles = [];
        foreach ($serverRoles as $role) {
            $this->addRole($role);
        }
        return $this;
    }

    /**
     * @param string $role
     * @return $this
     */
    public function addRole(string $role): self
    {
        $this->serverRoles[] = $role;
        return $this;
    }
}
