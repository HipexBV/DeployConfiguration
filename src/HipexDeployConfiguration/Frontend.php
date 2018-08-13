<?php
/**
 * @author Hipex <info@hipex.io>
 * @copyright (c) Hipex B.V. ${year}
 */

namespace HipexDeployConfiguration;

/**
 * Frontend build configurations
 */
class Frontend
{
    /**
     * Frontend constructor.
     *
     * @param string $buildDirectory
     * @param array $buildCommands
     */
    public function __construct(string $buildDirectory, array $buildCommands = ['yarn build'])
    {
    }
}
