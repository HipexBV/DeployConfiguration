<?php
/**
 * @author Hipex <info@hipex.io>
 * @copyright (c) Hipex B.V. 2018
 */

namespace HipexDeployConfiguration\Command\Build\Magento2;

use HipexDeployConfiguration\Command;

class DeployModeSet extends Command
{
    /**
     * DeployModeSet constructor.
     */
    public function __construct()
    {
        parent::__construct('{{bin/php}} bin/magento deploy:mode:set production --skip-compilation');
    }
}
