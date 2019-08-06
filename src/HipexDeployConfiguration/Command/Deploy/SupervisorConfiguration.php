<?php
/**
 * @author Emico <info@emico.nl>
 * @copyright (c) Emico B.V. 2019
 */
declare(strict_types = 1);

namespace HipexDeployConfiguration\Command\Deploy;

use HipexDeployConfiguration\DeployCommand;

class SupervisorConfiguration extends DeployCommand
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $supervisorCommand;

    /**
     * @var int
     */
    private $workers;

    /**
     * @var string[]
     */
    private $configuration;

    /**
     * @param string   $name
     * @param string   $supervisorCommand
     * @param int      $workers
     * @param string[] $configuration
     */
    public function __construct($name, $supervisorCommand, $workers = 1, $configuration = [])
    {
        $this->name = $name;
        $this->supervisorCommand = $supervisorCommand;
        $this->workers = $workers;
        $this->configuration = $configuration;
        parent::__construct();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getSupervisorCommand()
    {
        return $this->supervisorCommand;
    }

    /**
     * @return int
     */
    public function getWorkers()
    {
        return $this->workers;
    }

    /**
     * @return string[]
     */
    public function getConfiguration(): array
    {
        return $this->configuration;
    }
}
