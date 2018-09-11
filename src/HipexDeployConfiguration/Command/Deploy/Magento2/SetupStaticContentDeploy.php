<?php
/**
 * @author Hipex <info@hipex.io>
 * @copyright (c) Hipex B.V. 2018
 */

namespace HipexDeployConfiguration\Command\Build\Magento2;

use HipexDeployConfiguration\DeployCommand;

class SetupStaticContentDeploy extends DeployCommand
{
    /**
     * Argument defaults
     */
    public const DEFAULT_LOCALES = ['en_US', 'nl_NL'];

    /**
     * @var array
     */
    private $locales;

    /**
     * DeployModeSet constructor.
     *
     * @param array $locales
     */
    public function __construct(array $locales = self::DEFAULT_LOCALES)
    {
        parent::__construct('{{bin/php}} bin/magento setup:static-content:deploy --force {{magento2/locales}}');
        $this->locales = $locales;
    }

    /**
     * @return array|string[]
     */
    public function getLocales(): array
    {
        return $this->locales;
    }
}
