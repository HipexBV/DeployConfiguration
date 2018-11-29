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
     * @param string|null $area
     * @param array $arguments
     */
    public function __construct(array $locales = null, string $area = null, array $arguments = [])
    {
        parent::__construct('{{bin/php}} bin/magento setup:static-content:deploy --force {{magento2/static-content-arguments}} {{magento2/locales}}');

        set('magento2/locales', function() use ($locales) {
            return $locales ? implode(' ', $locales) : '';
        });

        set('magento2/static-content-arguments', function() use ($area, $arguments) {
            $arguments = [];

            if ($area) {
                $arguments[] = '--area=' . $area;
            }

            return implode(' ', $arguments);
        });
    }
}
