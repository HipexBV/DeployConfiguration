<?php
/**
 * @author Hipex <info@hipex.io>
 * @copyright (c) Hipex B.V. ${year}
 */

namespace HipexDeployConfiguration\Configuration;

use HipexDeployConfiguration\Configuration;
use HipexDeployConfiguration\DeployCommand;
use HipexDeployConfiguration\ServerRole;

class Magento2 extends Configuration
{
    public function __construct(string $gitRepository)
    {
        parent::__construct($gitRepository);

        $this->initializeDefaultConfiguration();
    }

    /**
     * Initialize defaults
     */
    private function initializeDefaultConfiguration(): void
    {
        $this->addDeployCommand(
            (new DeployCommand('{{phpbin}} setup:upgrade'))->setServerRoles([ServerRole::APPLICATION_FIRST])
        );

        $this->setSharedFiles([
            'app/etc/env.php.xml',
            'pub/errors/local.xml',
        ]);

        $this->setSharedFolders([
            'var/log',
            'var/session',
            'var/report',
            'pub/media',
        ]);
    }
}
