<?php
/**
 * @author Hipex <info@hipex.io>
 * @copyright (c) Hipex B.V. 2018
 */

namespace HipexDeployConfiguration;

use HipexDeployConfiguration\Command\Command;
use HipexDeployConfiguration\Command\DeployCommand;
use HipexDeployConfiguration\PlatformService\PlatformServiceInterface;
use HipexDeployConfiguration\PlatformConfiguration\PlatformConfigurationInterface;

class Configuration
{
    /**
     * Default deploy excluded files
     */
    private const DEFAULT_DEPLOY_EXCLUDE = [
        './.git',
        './.github',
        './deploy.php',
        './.gitlab-ci.yml',
        './Jenkinsfile',
        '.DS_Store',
        '.idea',
        '.gitignore',
        '*.scss',
        '*.less',
        '*.jsx',
        '*.ts',
    ];

    /**
     * Git repository of the project, this is required.
     *
     * @var string
     */
    private $gitRepository;

    /**
     * Deploy stages / environments. Usually production and test.
     *
     * @var Stage[]
     */
    private $stages = [];

    /**
     * Shared folders between deploys. Commonly used for `media`, `var/import` folders etc.
     * @var string[]
     */
    private $sharedFolders = [];

    /**
     * Files shared between deploys. Commonly used for database configurations etc.
     *
     * @var string[]
     */
    private $sharedFiles = [];

    /**
     *
     * Add file / directory that will not be deployed. File patterns are added as `tar --exclude=`;
     *
     * @var string[]
     */
    private $deployExclude = self::DEFAULT_DEPLOY_EXCLUDE;

    /**
     * Commands to run prior to deploying the application to build everything. For example de M2 static content deploy
     * or running your gulp build.
     *
     * @var Command[]
     */
    private $buildCommands = [];

    /**
     * Commands to run on all or specific servers to deploy.
     *
     * @var DeployCommand[]
     */
    private $deployCommands = [];

    /**
     * Commands to execute after successful deploy. Commonly used to send deploy email or push a New Relic deploy tag.
     * These commands are run on the production server(s).
     *
     * @var Command[]
     */
    private $afterDeployTasks = [];

    /**
     * Server configurations to automatically provision from your repository to the Hipex platform
     *
     * @var array
     */
    private $platformConfigurations = [];

    /**
     * Addition services to run
     *
     * @var array
     */
    private $platformServices = [];

    /**
     * @var string
     */
    private $phpVersion = 'php72';

    /**
     * @var string
     */
    private $publicFolder = 'pub';

    /**
     * ServerConfiguration constructor.
     *
     * @param string $gitRepository
     */
    public function __construct(string $gitRepository)
    {
        $this->gitRepository = $gitRepository;
    }

    /**
     * @return string
     */
    public function getGitRepository(): string
    {
        return $this->gitRepository;
    }

    /**
     * @param string $name
     * @param string $domain
     * @param string $username
     * @return Stage
     */
    public function addStage(string $name, string $domain, string $username): Stage
    {
        $stage = new Stage($name, $domain, $username);
        $this->stages[] = $stage;
        return $stage;
    }

    /**
     * @return Stage[]
     */
    public function getStages(): array
    {
        return $this->stages;
    }

    /**
     * @param array $folders
     * @return $this
     */
    public function setSharedFolders(array $folders): self
    {
        $this->sharedFolders = [];
        foreach ($folders as $folder) {
            $this->addSharedFolder($folder);
        }
        return $this;
    }

    /**
     * @param string $folder
     * @return $this
     */
    public function addSharedFolder(string $folder): self
    {
        $this->sharedFolders[] = $folder;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getSharedFolders(): array
    {
        return $this->sharedFolders;
    }

    /**
     * @param array $files
     * @return $this
     */
    public function setSharedFiles(array $files): self
    {
        $this->sharedFiles = [];
        foreach ($files as $file) {
            $this->addSharedFile($file);
        }
        return $this;
    }

    /**
     * @param string $file
     * @return $this
     */
    public function addSharedFile(string $file): self
    {
        $this->sharedFiles[] = $file;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getSharedFiles(): array
    {
        return $this->sharedFiles;
    }

    /**
     * @param array $excludes
     * @return $this
     */
    public function setDeployExclude(array $excludes): self
    {
        $this->deployExclude = [];
        foreach ($excludes as $exclude) {
            $this->addDeployExclude($exclude);
        }
        return $this;
    }

    /**
     * @param string $exclude
     * @return $this
     */
    public function addDeployExclude(string $exclude): self
    {
        $this->deployExclude[] = $exclude;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getDeployExclude(): array
    {
        return $this->deployExclude;
    }

    /**
     * @return Command[]
     */
    public function getBuildCommands(): array
    {
        return $this->buildCommands;
    }

    /**
     * @param Command[] $buildCommands
     * @return $this
     */
    public function setBuildCommands(array $buildCommands): self
    {
        $this->buildCommands = [];
        foreach ($buildCommands as $command) {
            $this->addBuildCommand($command);
        }
        return $this;
    }

    /**
     * @param Command $command
     * @return $this
     */
    public function addBuildCommand(Command $command): self
    {
        $this->buildCommands[] = $command;
        return $this;
    }

    /**
     * @return DeployCommand[]
     */
    public function getDeployCommands(): array
    {
        return $this->deployCommands;
    }

    /**
     * @param DeployCommand[] $deployCommands
     * @return $this
     */
    public function setDeployCommands($deployCommands): self
    {
        $this->deployCommands = [];
        foreach ($deployCommands as $command) {
            $this->addDeployCommand($command);
        }
        return $this;
    }

    /**
     * @param DeployCommand $command
     * @return $this
     */
    public function addDeployCommand(DeployCommand $command): self
    {
        $this->deployCommands[] = $command;
        return $this;
    }

    /**
     * @return Command
     */
    public function getAfterDeployTasks(): array
    {
        return $this->afterDeployTasks;
    }

    /**
     * @param Command[] $afterDeployTasks
     * @return $this
     */
    public function setAfterDeployTasks($afterDeployTasks): self
    {
        $this->afterDeployTasks = [];
        foreach ($afterDeployTasks as $command) {
            $this->addAfterDeployCommand($command);
        }
        return $this;
    }

    /**
     * @param Command $command
     * @return $this
     */
    public function addAfterDeployCommand(Command $command): self
    {
        $this->afterDeployTasks[] = $command;
        return $this;
    }

    /**
     * @return PlatformConfigurationInterface[]
     */
    public function getPlatformConfigurations(): array
    {
        return $this->platformConfigurations;
    }

    /**
     * @param PlatformConfigurationInterface[] $platformConfigurations
     * @return $this
     */
    public function setPlatformConfigurations(array $platformConfigurations): self
    {
        $this->platformConfigurations = [];
        foreach ($platformConfigurations as $serverConfiguration) {
            $this->addServerConfiguration($serverConfiguration);
        }
        return $this;
    }

    /**
     * @param PlatformConfigurationInterface $platformConfiguration
     * @return Configuration
     */
    public function addPlatformConfiguration(PlatformConfigurationInterface $platformConfiguration): self
    {
        $this->platformConfigurations[] = $platformConfiguration;
        return $this;
    }

    /**
     * @return PlatformServiceInterface[]
     */
    public function getPlatformServices(): array
    {
        return $this->platformServices;
    }

    /**
     * @param PlatformServiceInterface[] $platformServices
     * @return $this
     */
    public function setPlatformServices(array $platformServices): self
    {
        $this->platformServices = [];
        foreach ($platformServices as $platformService) {
            $this->addPlatformService($platformService);
        }
        return $this;
    }

    /**
     * @param PlatformServiceInterface $platformService
     * @return Configuration
     */
    public function addPlatformService(PlatformServiceInterface $platformService): self
    {
        $this->platformServices[] = $platformService;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhpVersion(): string
    {
        return $this->phpVersion;
    }

    /**
     * @param string $phpVersion
     */
    public function setPhpVersion(string $phpVersion): void
    {
        $this->phpVersion = $phpVersion;
    }

    /**
     * @return string
     */
    public function getPublicFolder(): string
    {
        return $this->publicFolder;
    }

    /**
     * @param string $publicFolder
     */
    public function setPublicFolder(string $publicFolder): void
    {
        $this->publicFolder = $publicFolder;
    }
}
