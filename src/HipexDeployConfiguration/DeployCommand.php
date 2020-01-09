<?php
/**
 * @author Hipex <info@hipex.io>
 * @copyright (c) Hipex B.V. 2018
 */

namespace HipexDeployConfiguration;

class DeployCommand extends Command implements ServerRoleConfigurableInterface
{
    use ServerRoleConfigurableTrait;
}
