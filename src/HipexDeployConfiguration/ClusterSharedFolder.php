<?php
/**
 * @author Emico <info@emico.nl>
 * @copyright (c) Emico B.V. 2020
 */
declare(strict_types = 1);

namespace HipexDeployConfiguration;

/**
 * Folder will be shared over releases and all servers within cluster
 */
class ClusterSharedFolder extends SharedFolder
{
    use ClusterSharedTrait;

    /**
     * @param string $folder
     * @param string $owningServerRole
     */
    public function __construct(string $folder, string $owningServerRole = ServerRole::LOAD_BALANCER)
    {
        parent::__construct($folder);
        $this->setOwningServerRole($owningServerRole);
    }
}
