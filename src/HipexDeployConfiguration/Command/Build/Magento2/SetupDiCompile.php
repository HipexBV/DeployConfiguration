<?php
/**
 * @author Hipex <info@hipex.io>
 * @copyright (c) Hipex B.V. 2018
 */

namespace HipexDeployConfiguration\Command\Build\Magento2;

use HipexDeployConfiguration\Command;

class SetupDiCompile extends Command
{
    /**
     * DeployModeSet constructor.
     */
    public function __construct()
    {
        parent::__construct('{{bin/php}} bin/magento setup:di:compile');
    }
}
