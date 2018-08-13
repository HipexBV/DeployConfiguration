<?php
/**
 * @author Hipex <info@hipex.io>
 * @copyright (c) Hipex B.V. ${year}
 */

namespace HipexDeployConfiguration;

/**
 * Start by setting up the configuration
 *
 * The magento 1 configuration contains some default configuration for shared folders / files and running installers
 * @see Configuration\Magento2::initializeDefaultConfiguration
 */
$configuration = new Configuration\Magento2('https://github.com/HipexBV/DeployConfiguration.git');

$productionStage = $configuration->addStage('production', 'example.com', 'example');
$productionStage->addServer('production201.hipex.io');

return $configuration;
