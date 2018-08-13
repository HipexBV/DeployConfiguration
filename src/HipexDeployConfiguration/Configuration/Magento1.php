<?php
/**
 * @author Hipex <info@hipex.io>
 * @copyright (c) Hipex B.V. ${year}
 */

namespace HipexDeployConfiguration\Configuration;

use HipexDeployConfiguration\Configuration;
use HipexDeployConfiguration\DeployCommand;
use HipexDeployConfiguration\ServerRole;

class Magento1 extends Configuration
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
            (new DeployCommand('magerun sys:setup:run'))->setServerRoles([ServerRole::APPLICATION_FIRST])
        );

        $this->setSharedFiles([
            'app/etc/local.xml',
            'errors/local.xml',
        ]);

        $this->setSharedFolders([
            'var',
            'media',
            'sitemap',
        ]);
    }
}
