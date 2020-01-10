<?php
/**
 * @author Hipex <info@hipex.io>
 * @copyright (c) Hipex B.V. 2020
 */

namespace HipexDeployConfiguration\PlatformConfiguration;

use HipexDeployConfiguration\ServerRoleConfigurableInterface;
use HipexDeployConfiguration\ServerRoleConfigurableTrait;
use HipexDeployConfiguration\TaskConfigurationInterface;

class NginxConfiguration implements TaskConfigurationInterface, ServerRoleConfigurableInterface
{
    use ServerRoleConfigurableTrait;

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
