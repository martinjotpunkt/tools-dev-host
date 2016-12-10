<?php
namespace Component\Retriever;

use AppBundle\Model\ProjectModel;
use Component\Model\ProjectModelInterface;
use Docker\Context\Context;
use Docker\Context\ContextInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

class ProjectRetriever implements RetrieverInterface
{
    const FILENAME_DOCKERFILE = 'Dockerfile';

    /** @var string */
    private $projectDir;

    /** @var string */
    private $dockerDir;


    public function __construct($projectDirectory, $dockerDir)
    {
        $this->projectDir = $projectDirectory;
        $this->dockerDir = $dockerDir;
    }

    /**
     * @param $name string
     *
     * @return ProjectModelInterface
     */
    public function findOne($name)
    {
        $projects = $this->getProjectDirectories()->name($name);
        $projectIterator = $projects->getIterator();

        if(1 > $projects->count()) {
            return null;
        }

        $projectIterator->rewind();

        return $this->createProjectFromFileInfo($projectIterator->current());
    }


    /**
     * @return ProjectModelInterface[]
     */
    public function findAll()
    {
        $projects = [];

        foreach ($this->getProjectDirectories() as $fileInfo) {
            $projects[] = $this->createProjectFromFileInfo($fileInfo);
        }

        return $projects;
    }



    /**
     * @return Finder
     */
    private function getFinder()
    {
        $finder = new Finder();

        return $finder;
    }


    /**
     * @return Finder|SplFileInfo[]
     */
    private function getProjectDirectories()
    {
        return $this->getFinder()->directories()->in($this->projectDir)->depth('== 0');
    }


    /**
     * @param SplFileInfo $info
     *
     * @return ProjectModelInterface
     */
    private function createProjectFromFileInfo(SplFileInfo $info)
    {
        return new ProjectModel($info->getBasename(), $info->getRealPath(), $this->getDockerContext($info));
    }


    /**
     * @param SplFileInfo $baseDir
     *
     * @return ContextInterface
     */
    private function getDockerContext(SplFileInfo $baseDir)
    {
        return new Context($baseDir->getRealPath() . $this->dockerDir);
    }
}
