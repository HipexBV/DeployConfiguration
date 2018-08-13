<?php
/**
 * @author Hipex <info@hipex.io>
 * @copyright (c) Hipex B.V. 2018
 */

namespace HipexDeployConfiguration\Command;

use HipexDeployConfiguration\Command;
use HipexDeployConfiguration\Exception\EnvironmentVariableNotDefinedException;
use function HipexDeployConfiguration\getenv;

class SlackWebhook extends Command
{
    /**
     * @var string
     */
    private $webHook;

    /**
     * NewRelic constructor.
     *
     * @param string|null $webHook Defaults to env `SLACK_WEBHOOK`
     * @throws EnvironmentVariableNotDefinedException
     */
    public function __construct(string $webHook = null)
    {
        parent::__construct();
        $this->webHook = $webHook ?: getenv('SLACK_WEBHOOK');
    }

    /**
     * @return string
     */
    public function getWebHook(): string
    {
        return $this->webHook;
    }
}
