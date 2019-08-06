<?php
/**
 * @author Emico <info@emico.nl>
 * @copyright (c) Emico B.V. 2019
 */
declare(strict_types = 1);

namespace HipexDeployConfiguration\Command\Deploy;

use HipexDeployConfiguration\DeployCommand;

class NginxConfiguration extends DeployCommand
{
    /**
     * @var string
     */
    private $sourceFolder;

    /**
     * @param string $sourceFolder
     */
    public function __construct($sourceFolder = 'etc/nginx/')
    {
        $this->sourceFolder = $sourceFolder;
    }

    /**
     * @return string
     */
    public function getSourceFolder()
    {
        return $this->sourceFolder;
    }
}
