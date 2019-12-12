<?php
namespace HipexDeployConfiguration;

interface OptionalCommandInterface
{
    /**
     * @return bool
     */
    public function shouldExecuteCommand(): bool;
}