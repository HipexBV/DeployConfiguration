<?php
/**
 * @author Hipex <info@hipex.io>
 * @copyright (c) Hipex B.V. 2018
 */

namespace HipexDeployConfiguration;

class ServerRole
{
    public const APP = 'app';
    public const BUILD = 'build';
    public const LOAD_BALANCER = 'load_balancer';
    public const DATABASE = 'database';

    /**
     * @return string[]
     */
    public static function getValues(): array
    {
        return [
            self::APP,
            self::BUILD,
            self::LOAD_BALANCER,
            self::DATABASE,
        ];
    }
}
