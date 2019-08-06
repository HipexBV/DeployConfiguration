<?php
/**
 * @author Emico <info@emico.nl>
 * @copyright (c) Emico B.V. 2019
 */
declare(strict_types = 1);

namespace HipexDeployConfiguration\Command\Deploy;

use HipexDeployConfiguration\DeployCommand;
use HipexDeployConfiguration\ServerRole;

class CronConfiguration extends DeployCommand
{
    /**
     * @var string
     */
    private $sourceFile;

    /**
     * @param string $sourceFolder
     */
    public function __construct($sourceFile = 'etc/cron')
    {
        $this->sourceFile = $sourceFile;
        $this->setServerRoles([ServerRole::APPLICATION_FIRST]);
    }

    /**
     * @return string
     */
    public function getSourceFile()
    {
        return $this->sourceFile;
    }
}
