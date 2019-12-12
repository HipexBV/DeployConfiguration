<?php
/**
 * @author Hipex <info@hipex.io>
 * @copyright (c) Hipex B.V. 2018
 */

namespace HipexDeployConfiguration\Command\Build;

use function Deployer\test;
use HipexDeployConfiguration\Command;
use HipexDeployConfiguration\OptionalCommandInterface;

class Composer extends Command implements OptionalCommandInterface
{
    /**
     * Default installation arguments
     */
    public const DEFAULT_INSTALL_ARGUMENTS = [
        '--verbose',
        '--no-progress',
        '--no-interaction',
        '--optimize-autoloader',
        '--no-dev',
        '--ignore-platform-reqs',
    ];

    /**
     * @var string[]
     */
    private $installArguments;

    /**
     * Composer constructor.
     *
     * @param string[] $installArguments
     */
    public function __construct(array $installArguments = self::DEFAULT_INSTALL_ARGUMENTS)
    {
        parent::__construct('{{bin/composer}} install {{composer/install_arguments}}');

        $this->installArguments = $installArguments;
    }

    /**
     * @return string[]
     */
    public function getInstallArguments(): array
    {
        return $this->installArguments;
    }

    /**
     * @return bool
     */
    public function shouldExecuteCommand(): bool
    {
        return !test('[ -d vendor ]');
    }
}
