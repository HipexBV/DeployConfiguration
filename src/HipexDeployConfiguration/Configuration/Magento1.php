<?php
/**
 * @author Hipex <info@hipex.io>
 * @copyright (c) Hipex B.V. ${year}
 */

namespace HipexDeployConfiguration\Configuration;

use HipexDeployConfiguration\Configuration;
use HipexDeployConfiguration\Command;
use HipexDeployConfiguration\DeployCommand;
use HipexDeployConfiguration\ServerRole;

class Magento1 extends Configuration
{
    /**
     * Magento1 constructor.
     *
     * @param string $gitRepository
     */
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
        $this->addBuildCommand(new Command\Build\Composer());
        
        $this->addDeployCommand((new DeployCommand('magerun sys:setup:run'))->setServerRoles([ServerRole::APPLICATION_FIRST]));
        $this->addDeployCommand((new DeployCommand('magerun cache:flush'))->setServerRoles([ServerRole::APPLICATION_FIRST]));

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
