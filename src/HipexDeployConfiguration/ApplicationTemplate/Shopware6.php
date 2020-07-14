<?php

namespace HipexDeployConfiguration\ApplicationTemplate;

use HipexDeployConfiguration\Configuration;
use HipexDeployConfiguration\Command;

class Shopware6 extends Configuration
{
    /**
     * Shopware6 constructor.
     * @param string $gitRepository
     */
    public function __construct(string $gitRepository)
    {
        parent::__construct($gitRepository);

        $this->initializeDefaultConfiguration();
    }

    /**
     * Initialize defaults
     *
     */
    private function initializeDefaultConfiguration(): void
    {
        $this->setPhpVersion('php72');


        $this->addBuildCommand(new Command\Build\Composer([
            '--verbose',
            '--no-progress',
            '--no-interaction',
            '--optimize-autoloader',
            '--ignore-platform-reqs',
        ]));

        $this->addBuildCommand(new Command\Build\Shopware6\ThemeCompile());
        $this->addBuildCommand(new Command\Build\Shopware6\BuildAdministration());
        $this->addBuildCommand(new Command\Build\Shopware6\BuildStorefront());

        $this->addDeployCommand(new Command\Deploy\Shopware6\CacheClear());

        $this->setSharedFiles([
            '.env',
        ]);

        $this->setSharedFolders([
            'config/jwt',
            'var/log',
            'public/sitemap',
            'public/media',
            'public/thumbnail'
        ]);
    }
}
