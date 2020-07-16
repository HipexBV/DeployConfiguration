<?php
/**
 * @author Hipex <info@hipex.io>
 * @copyright (c) Hipex B.V. ${year}
 */

namespace HipexDeployConfiguration;

/**
 * Start by setting up the configuration
 *
 * The shopware 6 configuration contains some default configuration for shared folders / files and build + deploy commands
 * @see ApplicationTemplate\Shopware6::initializeDefaultConfiguration
 */
$configuration = new ApplicationTemplate\Shopware6('https://github.com/HipexBV/DeployConfiguration.git');

$productionStage = $configuration->addStage('production', 'example.com', 'example');
$productionStage->addServer('production201.hipex.io');

return $configuration;
