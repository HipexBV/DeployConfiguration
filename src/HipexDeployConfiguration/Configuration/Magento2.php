<?php
/**
 * @author Hipex <info@hipex.io>
 * @copyright (c) Hipex B.V. ${year}
 */

namespace HipexDeployConfiguration\Configuration;

use HipexDeployConfiguration\Configuration;
use HipexDeployConfiguration\Command;

class Magento2 extends Configuration
{
    /**
     * Magento2 constructor.
     *
     * @param string $gitRepository
     * @param string[]|null $locales
     */
    public function __construct(string $gitRepository, array $locales = null)
    {
        parent::__construct($gitRepository);

        $this->initializeDefaultConfiguration($locales);
    }

    /**
     * Initialize defaults
     *
     * @param string[]|null $locales
     */
    private function initializeDefaultConfiguration(array $locales = null): void
    {
        $this->setPhpVersion('php71');
        $this->addBuildCommand(new Command\Build\Composer());
        $this->addBuildCommand(new Command\Build\Magento2\SetupDiCompile());
        $this->addBuildCommand(new Command\Build\Magento2\SetupStaticContentDeploy($locales));

        $this->addDeployCommand(new Command\Deploy\Magento2\MaintenanceMode());
        $this->addDeployCommand(new Command\Deploy\Magento2\SetupUpgrade());
        $this->addDeployCommand(new Command\Deploy\Magento2\CacheFlush());

        $this->setSharedFiles([
            'app/etc/env.php',
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
