<?php
/**
 * @author Hipex <info@hipex.io>
 * @copyright (c) Hipex B.V. 2020
 */

namespace HipexDeployConfiguration\ServerConfiguration;

use HipexDeployConfiguration\ServerRoleConfigurableInterface;
use HipexDeployConfiguration\ServerRoleConfigurableTrait;

class NginxConfiguration implements ServerConfigurationInterface, ServerRoleConfigurableInterface
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
