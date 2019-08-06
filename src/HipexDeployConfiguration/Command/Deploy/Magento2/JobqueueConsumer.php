<?php
/**
 * @author Hipex <info@hipex.io>
 * @copyright (c) Hipex B.V. 2018
 */

namespace HipexDeployConfiguration\Command\Deploy\Magento2;

use HipexDeployConfiguration\DeployCommand;
use HipexDeployConfiguration\ServerRole;

class JobqueueConsumer extends DeployCommand
{
    /**
     * @var string
     */
    private $consumer;

    /**
     * @var int
     */
    private $workers;

    /**
     * Create jobqueue consumer managed by supervisor
     */
    public function __construct(string $consumer, int $workers = 1)
    {
        $this->consumer = $consumer;
        $this->workers = $workers;
        $this->setServerRoles([ServerRole::APPLICATION_FIRST]);
    }

    /**
     * @return string
     */
    public function getConsumer()
    {
        return $this->consumer;
    }

    /**
     * @return int
     */
    public function getWorkers()
    {
        return $this->workers;
    }
}
