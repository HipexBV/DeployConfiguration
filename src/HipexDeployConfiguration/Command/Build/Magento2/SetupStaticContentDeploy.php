<?php
/**
 * @author Hipex <info@hipex.io>
 * @copyright (c) Hipex B.V. 2018
 */

namespace HipexDeployConfiguration\Command\Build\Magento2;

use function Deployer\set;
use HipexDeployConfiguration\Command;

class SetupStaticContentDeploy extends Command
{
    /**
     * Argument defaults
     */
    public const DEFAULT_LOCALES = ['en_US', 'nl_NL'];

    /**
     * DeployModeSet constructor.
     *
     * @param array $locales
     */
    public function __construct(array $locales = self::DEFAULT_LOCALES)
    {
        parent::__construct('{{bin/php}} bin/magento setup:static-content:deploy --force {{magento2/locales}}');
        set('magento2/locales', implode(' ', $locales));
    }
}
