<?php
/**
 * @author Hipex <info@hipex.io>
 * @copyright (c) Hipex B.V. 2018
 */

namespace HipexDeployConfiguration;

/**
 * Frontend build configurations
 */
class Frontend
{
    /**
     * @var string
     */
    private $buildDirectory;

    /**
     * @var string[]
     */
    private $buildCommands = [];

    /**
     * Frontend constructor.
     *
     * @param string $buildDirectory
     * @param array $buildCommands
     */
    public function __construct(array $buildCommands, string $buildDirectory)
    {
        $this->buildDirectory = $buildDirectory;
        $this->setBuildCommands($buildCommands);
    }

    /**
     * @return string
     */
    public function getBuildDirectory(): string
    {
        return $this->buildDirectory;
    }

    /**
     * @return string[]
     */
    public function getBuildCommands(): array
    {
        return $this->buildCommands;
    }

    /**
     * @param Command[] $buildCommands
     * @return $this
     */
    public function setBuildCommands(array $buildCommands): self
    {
        $this->buildCommands = [];
        foreach ($buildCommands as $command) {
            $this->addBuildCommand($command);
        }
        return $this;
    }

    /**
     * @param string $command
     * @return $this
     */
    public function addBuildCommand(string $command): self
    {
        $this->buildCommands[] = $command;
        return $this;
    }
}
