<?php
/**
 * @author Hipex <info@hipex.io>
 * @copyright (c) Hipex B.V. 2018
 */

namespace HipexDeployConfiguration\Command\Build\Magento2;

use function Deployer\test;
use HipexDeployConfiguration\Command;
use HipexDeployConfiguration\OptionalCommandInterface;

class SetupDiCompile extends Command implements OptionalCommandInterface
{
    /**
     * DeployModeSet constructor.
     */
    public function __construct()
    {
        parent::__construct('{{bin/php}} bin/magento setup:di:compile');
    }

    /**
     * @return bool
     */
    public function shouldExecuteCommand(): bool
    {
        return !test('[ -d generated ]');
    }
}
