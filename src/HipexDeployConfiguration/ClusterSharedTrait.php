<?php
/**
 * @author Emico <info@emico.nl>
 * @copyright (c) Emico B.V. 2020
 */
declare(strict_types = 1);

namespace HipexDeployConfiguration;

/**
 * File will be shared over releases and all servers within cluster
 */
trait ClusterSharedTrait
{
    /**
     * @var string
     */
    private $owningServerRole;

    /**
     * @param string $owningServerRole
     */
    public function setOwningServerRole(string $owningServerRole): void
    {
        $this->owningServerRole = $owningServerRole;
    }

    /**
     * @return string
     */
    public function getOwningServerRole(): string
    {
        return $this->owningServerRole;
    }
}
