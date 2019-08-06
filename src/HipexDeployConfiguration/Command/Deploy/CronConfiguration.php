<?php
/**
 * @author Emico <info@emico.nl>
 * @copyright (c) Emico B.V. 2019
 */
declare(strict_types = 1);

namespace HipexDeployConfiguration\Command\Deploy;

use HipexDeployConfiguration\DeployCommand;

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
    }

    /**
     * @return string
     */
    public function getSourceFile()
    {
        return $this->sourceFile;
    }
}
