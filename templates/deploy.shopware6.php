<?php

namespace Configuration\Deploy;

use HipexDeployConfiguration\Command\Build\Composer;
use HipexDeployConfiguration\Command\Command;
use HipexDeployConfiguration\Command\DeployCommand;
use HipexDeployConfiguration\Configuration;
use HipexDeployConfiguration\ServerRole;

class Deploy extends Configuration
{
    /**
     * Deploy constructor.
     */
    public function __construct()
    {
        // TODO: change git repo url to your own
        parent::__construct('git@github.com:HipexBV/DeployConfiguration.git');
        
        $this->setPhpVersion('php73');

        $this->configureEnvironments();
        $this->configureShared();
        $this->configureBuild();
        $this->configureDeploy();
        $this->configureExcluded();
    }

    private function configureEnvironments()
    {
        $this->configureEnvironmentStaging();
    }

    private function configureEnvironmentStaging()
    {
        $stageStaging = $this->addStage('staging', 'staging.example.com', 'example');
        $stageStaging->addServer('staging123.hipex.io');
    }

    private function configureShared()
    {
        $this->setSharedFiles(
            [
                
                '.env',
            ]
        );
        $this->setSharedFolders(
            [
                'config/jwt', // generate this app secret once after initial deployment, by ssh'ing into your server and executing `bin/console system:generate-jwt-secret` from within the `application/current` folder. 
                'var/log',
                'public/sitemap',
                'public/media',
                'public/thumbnail'
            ]
        );
    }

    private function configureExcluded()
    {
        $ignored = [
            '/.git',
            '/.idea',
            './.github',
            './deploy.php',
            '.DS_Store',
            '.gitignore',
            '*.less',
            '*.jsx',
            '*.ts',
            '/bin',
            '/build',
            '/config',
            '/public',
            '/src',
            '/.editorconfig',
            '/.env',
            '/.env.dist',
            '/.psh.yaml.dist',
            '/.dockerignore',
            '/.gitlab-ci.yml',
            '/.htaccess',
            '/bitbucket-pipelines.yml',
            '/docker-compose.yml',
            '/docker-compose.override.yml',
            '/license.txt',
            '/phpunit.xml.dist',
            '/psh.phar',
            'composer-cache',
            'auth.json',
            'COPYING*',
            'LICENSE*',
            'CHANGELOG*'
        ];
        $this->setDeployExclude($ignored);
    }

    private function configureBuild()
    {
        $composerInstallArguments = [
            '--verbose',
            '--no-progress',
            '--no-interaction',
            '--optimize-autoloader',
            '--ignore-platform-reqs',
        ];

        $composerCommand = new Composer($composerInstallArguments);
        $composerSwRecoveryCommand = new Command('{{bin/composer}} install -d vendor/shopware/recovery --no-interaction --optimize-autoloader --no-suggest');
        $buildAdministrationCommand = new Command('./bin/build-administration.sh');
        $buildStorefrontCommand = new Command('./bin/build-storefront.sh');


        $this->setBuildCommands([$composerCommand, $composerSwRecoveryCommand, $buildAdministrationCommand, $buildStorefrontCommand]);
    }

    private function configureDeploy()
    {
        // Commands that require database access must run as deploy command and run on the server, whilest build commands run in your CI container. 
        $systemInstallCommand = new DeployCommand('{{bin/php}} bin/console system:install --force');
        $buildThemeCommand = new DeployCommand('{{bin/php}} bin/console theme:compile');
        $this->addDeployCommand($systemInstallCommand);
        $this->addDeployCommand($buildThemeCommand);
    }
}

return new Deploy();
