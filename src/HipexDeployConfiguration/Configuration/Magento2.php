<?php
/**
 * @author Hipex <info@hipex.io>
 * @copyright (c) Hipex B.V. ${year}
 */

namespace HipexDeployConfiguration\Configuration;

use HipexDeployConfiguration\Command\Build\Magento2\SetupStaticContentDeploy;
use HipexDeployConfiguration\Configuration;
use HipexDeployConfiguration\Command;

class Magento2 extends Configuration
{
    /**
     * Magento2 constructor.
     *
     * @param string $gitRepository
     * @param string[] $locales
     */
    public function __construct(string $gitRepository, array $locales = SetupStaticContentDeploy::DEFAULT_LOCALES)
    {
        parent::__construct($gitRepository);

        $this->initializeDefaultConfiguration($locales);
    }

    /**
     * Initialize defaults
     *
     * @param string[] $locales
     */
    private function initializeDefaultConfiguration(array $locales): void
    {
        $this->addBuildCommand(new Command\Build\Composer());
        $this->addBuildCommand(new Command\Build\Magento2\DeployModeSet());
        $this->addBuildCommand(new Command\Build\Magento2\SetupDiCompile());

        $this->addDeployCommand(new Command\Build\Magento2\SetupStaticContentDeploy($locales));
        $this->addDeployCommand(new Command\Deploy\Magento2\MaintenanceMode());
        $this->addDeployCommand(new Command\Deploy\Magento2\SetupUpgrade());
        $this->addDeployCommand(new Command\Deploy\Magento2\CacheFlush());

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
