<?php
namespace BackendBundle\Model;

use Component\Model\ProjectModelInterface;

class ProjectModel implements ProjectModelInterface
{
    private $name;
    private $path;
    private $canBoot;


    public function __construct($name, $path)
    {
        $this->name = $name;
        $this->path = $path;
    }


    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }




    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }



    /**
     * @return mixed
     */
    public function getCanBoot()
    {
        return $this->canBoot;
    }


    /**
     * @param mixed $canBoot
     *
     * @return ProjectModel
     */
    public function setCanBoot($canBoot)
    {
        $this->canBoot = $canBoot;

        return $this;
    }
}
