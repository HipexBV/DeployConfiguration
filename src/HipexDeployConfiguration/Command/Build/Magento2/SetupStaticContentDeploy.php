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
     * DeployModeSet constructor.
     *
     * @param array $locales
     */
    public function __construct(array $locales = null)
    {
        parent::__construct('{{bin/php}} bin/magento setup:static-content:deploy --force {{magento2/locales}}');

        set('magento2/locales', function() use ($locales) {
            return $locales ? implode(' ', $locales) : '';
        });
    }
}
