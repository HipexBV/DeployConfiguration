<?php


namespace HipexDeployConfiguration;


interface ServerRoleConfigurableInterface
{
    /**
     * @param string[] $serverRoles
     * @return $this
     */
    public function setServerRoles(array $serverRoles);

    /**
     * @param string $role
     * @return self
     */
    public function addRole(string $role);
}