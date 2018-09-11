<?php
/**
 * @author Hipex <info@hipex.io>
 * @copyright (c) Hipex B.V. 2018
 */

namespace HipexDeployConfiguration\Command\Build;

use HipexDeployConfiguration\Command;

class Composer extends Command
{
    /**
     * Default installation arguments
     */
    public const DEFAULT_INSTALL_ARGUMENTS = '--verbose --no-progress --no-interaction --optimize-autoloader --no-dev';

    /**
     * @var string
     */
    private $installArguments;

    /**
     * Composer constructor.
     *
     * @param string $installArguments
     */
    public function __construct(string $installArguments = self::DEFAULT_INSTALL_ARGUMENTS)
    {
        parent::__construct('{{bin/composer}} install {{composer/install_arguments}}');

        $this->installArguments = $installArguments;
    }

    /**
     * @return string
     */
    public function getInstallArguments(): string
    {
        return $this->installArguments;
    }
}
