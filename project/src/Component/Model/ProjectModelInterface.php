<?php
namespace Component\Model;

use Docker\Context\ContextInterface;

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
     * @return ContextInterface
     */
    public function getContext();


    /**
    * @return bool
    */
    public function delete();
}
