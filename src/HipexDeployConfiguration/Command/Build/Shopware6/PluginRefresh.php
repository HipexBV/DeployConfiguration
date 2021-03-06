<?php

namespace HipexDeployConfiguration\Command\Build\Shopware6;

use function Deployer\test;
use function Deployer\run;
use HipexDeployConfiguration\Command\Command;

class PluginRefresh extends Command
{
    /**
     * PluginRefresh constructor.
     */
    public function __construct()
    {
        parent::__construct(function () {
            run('{{bin/php}} bin/console plugin:refresh');
        });
    }
}
