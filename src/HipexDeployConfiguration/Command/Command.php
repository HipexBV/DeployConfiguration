<?php
/**
 * @author Hipex <info@hipex.io>
 * @copyright (c) Hipex B.V. 2018
 */

namespace HipexDeployConfiguration\Command;

use HipexDeployConfiguration\TaskConfigurationInterface;

class Command implements TaskConfigurationInterface
{
    /**
     * Command to execute.
     *
     * @var string|callable
     */
    private $command;

    /**
     *
     * @var string
     */
    private $workingDirectory;

    /**
     * When set the command is only run on a specific stage
     *
     * @var string
     */
    private $stage;

    /**
     * DeployCommand constructor.
     *
     * @param string|callable $command
     */
    public function __construct($command = null)
    {
        $this->command = $command;
    }

    /**
     * @return string|callable
     */
    public function getCommand()
    {
        return $this->command;
    }

    /**
     * @return string
     */
    public function getWorkingDirectory(): ?string
    {
        return $this->workingDirectory;
    }

    /**
     * @param string $workingDirectory
     */
    public function setWorkingDirectory(string $workingDirectory): void
    {
        $this->workingDirectory = $workingDirectory;
    }

    /**
     * @return string
     */
    public function getStage(): ?string
    {
        return $this->stage;
    }

    /**
     * @param string $stage
     */
    public function setStage(string $stage): void
    {
        $this->stage = $stage;
    }
}
