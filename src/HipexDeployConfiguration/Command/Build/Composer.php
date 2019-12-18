<?php
/**
 * @author Hipex <info@hipex.io>
 * @copyright (c) Hipex B.V. 2018
 */

namespace HipexDeployConfiguration\Command\Build;

use function Deployer\run;
use function Deployer\test;
use HipexDeployConfiguration\Command;

class Composer extends Command
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
        parent::__construct(function() {
            if (!test('[ -f vendor/autoload.php ]')) {
                run('{{bin/composer}} install {{composer/install_arguments}}');
            }
        });

        $this->installArguments = $installArguments;
    }

    /**
     * @return string[]
     */
    public function getInstallArguments(): array
    {
        return $this->installArguments;
    }
}
