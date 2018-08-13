<?php
/**
 * @author Hipex <info@hipex.io>
 * @copyright (c) Hipex B.V. ${year}
 */

namespace HipexDeployConfiguration;

class Configuration
{
    /**
     * @var string
     */
    private $gitRepository;

    /**
     * @var Stage[]
     */
    private $stages = [];

    /**
     * @var string[]
     */
    private $sharedFolders = [];

    /**
     * @var string[]
     */
    private $sharedFiles = [];

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
     * @return Stage
     */
    public function addStage(string $name, string $domain): Stage
    {
        $stage = new Stage($domain);
        $this->stages[$name] = $stage;
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
}
