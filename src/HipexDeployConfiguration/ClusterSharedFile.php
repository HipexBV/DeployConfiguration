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
class ClusterSharedFile extends SharedFile
{
    use ClusterSharedTrait;

    /**
     * @param string $file
     * @param string $owningServerRole
     */
    public function __construct(string $file, string $owningServerRole = ServerRole::LOAD_BALANCER)
    {
        parent::__construct($file);
        $this->setOwningServerRole($owningServerRole);
    }
}
