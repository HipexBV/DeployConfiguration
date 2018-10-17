<?php
/**
 * @author Hipex <info@hipex.io>
 * @copyright (c) Hipex B.V. 2018
 */

namespace HipexDeployConfiguration\Command\Deploy\Magento2;

use HipexDeployConfiguration\DeployCommand;

class SetupDiCompile extends DeployCommand
{
    /**
     * DeployModeSet constructor.
     */
    public function __construct()
    {
        parent::__construct('{{bin/php}} bin/magento setup:di:compile');
    }
}
