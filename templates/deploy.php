<?php
/**
 * @author Hipex <info@hipex.io>
 * @copyright (c) Hipex B.V. ${year}
 */
/** @noinspection PhpUnhandledExceptionInspection */

// Namespace declaration is not required but just removes the pain of having to use all the config classes separately
namespace HipexDeployConfiguration;

/**
 * Start by setting up the configuration
 *
 * Obviously 'https://github.com/HipexBV/DeployConfiguration.git' is an example. This should be the url to your git repo
 */
$configuration = new Configuration('https://github.com/HipexBV/DeployConfiguration.git');





/**
 * We will setup a cluster environment with a load balancer, 2 app servers and a database server.
 * If your setup only contains one server you can leave out the roles argument and just setup 1 server
 *
 * Please note that currently varnish is not automatically configured, for help configuring varnish please contact support.
 */
$productionStage = $configuration->addStage(
    'production', // Name for the deployment stage
    'example.com', // Domain name
    'example' // SSH User
);
$productionStage->addServer('production201.hipex.io', [ServerRole::LOAD_BALANCER, ServerRole::VARNISH]);
$productionStage->addServer('production202.hipex.io', [ServerRole::APPLICATION, ServerRole::APPLICATION_FIRST]);
$productionStage->addServer('production203.hipex.io', [ServerRole::APPLICATION]);
$productionStage->addServer('production204.hipex.io', [ServerRole::DATABASE, ServerRole::REDIS]);





/**
 * Next is the test environment
 *
 * With `addServer` we leave the roles argument empty so this server will fulfill al deployment roles.
 */
$testStage = $configuration->addStage('test', 'test.example.com', 'example');
$testStage->addServer('production205');




/**
 * Adding extra deploy commands allow you to add actions to your deploy.
 *
 * Here are some examples. Configuration from these examples is mostly set trough the environment variables. They
 * can also be set using the constructor arguments of the commands.
 */
$configuration->addAfterDeployCommand(new Command\NewRelic());
$configuration->addAfterDeployCommand(new Command\EmailNotification());
$configuration->addAfterDeployCommand(new Command\SlackWebhook(
    'https://hooks.slack.com/services/T00000000/B00000000/XXXXXXXXXXXXXXXXXXXXXXXX'
));




/**
 * Running a Magento 1 deploy with frontend build
 */
$configuration->addFrontend(new Frontend(['yarn install', 'yarn build'], 'skin/frontend/package/theme'));
$setupRun = (new DeployCommand('magerun sys:setup:run'))->setServerRoles([ServerRole::APPLICATION_FIRST]);
$configuration->addDeployCommand($setupRun);




/**
 * A simple Magento 2 build
 */
$configuration->addBuildCommand(new Command('{{phpbin}} bin/magento setup:di:compile'));
$configuration->addBuildCommand(new Command('{{phpbin}} bin/magento setup:static-content:deploy'));
$setupRun = (new DeployCommand('{{phpbin}} setup:upgrade'))->setServerRoles([ServerRole::APPLICATION_FIRST]);
$configuration->addDeployCommand($setupRun);




/**
 * Return our configuration to the deploy image
 */
return $configuration;
