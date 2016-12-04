<?php
namespace Component\Retriever;

use Component\Model\ProjectModelInterface;

interface ProjectRetrieverInterface
{
    /**
     * @return ProjectModelInterface[]
     */
    public function findAll();


    /**
     * @param $name string
     *
     * @return ProjectModelInterface
     */
    public function findOne($name);
}
