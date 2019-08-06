<?php
/**
 * @author Hipex <info@hipex.io>
 * @copyright (c) Hipex B.V. 2018
 */

namespace HipexDeployConfiguration\Command\Deploy\Magento2;

use HipexDeployConfiguration\Command\Deploy\SupervisorConfiguration;
use HipexDeployConfiguration\ServerRole;

class JobQueueConsumer extends SupervisorConfiguration
{
    /**
     * @var string
     */
    private $consumer;

    /**
     * @var int
     */
    private $maxMessages;

    /**
     * Create jobqueue consumer managed by supervisor
     * @param string $consumer
     * @param int    $workers
     * @param int    $maxMessages
     */
    public function __construct(string $consumer, int $workers = 1, int $maxMessages = 100)
    {
        $this->consumer = $consumer;
        $this->maxMessages = $maxMessages;
        $this->setServerRoles([ServerRole::APPLICATION_FIRST]);
        $this->setWorkingDirectory('{{release_path/realpath}}');
        parent::__construct('jobqueue-consumer-' . $consumer, '', $workers);
    }

    /**
     * @return string
     */
    public function getSupervisorCommand()
    {
        return implode(' ', [
            sprintf('logrun consumer.%s', $this->consumer),
            'timeout 600 {{bin/php}} bin/magento',
            sprintf('queue:consumers:start %s', $this->consumer),
            sprintf('--max-messages=%s', $this->maxMessages),
        ]);
    }
}
