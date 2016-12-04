<?php
namespace Component\Model;

interface ProjectModelInterface
{
    /**
     * @return string
     */
    public function getName();


    /**
     * @return string
     */
    public function getPath();


    /**
     * @param $canBoot boolean
     *
     * @return string
     */
    public function setCanBoot($canBoot);


    /**
     * @return boolean
     */
    public function getCanBoot();
}
