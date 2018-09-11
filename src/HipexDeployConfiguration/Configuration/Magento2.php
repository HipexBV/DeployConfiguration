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

class Magento2 extends Configuration
{
    /**
     * Argument defaults
     */
    public const DEFAULT_LOCALES = ['en_US', 'nl_NL'];

    /**
     * @var array|string[]
     */
    private $locales;

    /**
     * Magento2 constructor.
     *
     * @param string $gitRepository
     * @param string[] $locales
     */
    public function __construct(string $gitRepository, array $locales = self::DEFAULT_LOCALES)
    {
        parent::__construct($gitRepository);

        $this->initializeDefaultConfiguration();
        $this->locales = $locales;
    }

    /**
     * @return array|string[]
     */
    public function getLocales(): array
    {
        return $this->locales;
    }

    /**
     * Initialize defaults
     */
    private function initializeDefaultConfiguration(): void
    {
        $this->addBuildCommand(new Command\Build\Composer());
        $this->addBuildCommand(new Command('{{bin/php}} bin/magento deploy:mode:set production --skip-compilation'));
        $this->addBuildCommand(new Command('{{bin/php}} bin/magento setup:di:compile'));
        $this->addBuildCommand(new Command('{{bin/php}} bin/magento setup:static-content:deploy --force {{magento2/locales}}'));

        $this->addDeployCommand((new DeployCommand('{{bin/php}} bin/magento setup:upgrade --keep-generated'))->setServerRoles([ServerRole::APPLICATION_FIRST]));
        $this->addDeployCommand((new DeployCommand('{{bin/php}} bin/magento cache:flush'))->setServerRoles([ServerRole::APPLICATION_FIRST]));

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
