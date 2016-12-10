<?php
namespace Component\Retriever;

use Component\Model\ProjectModelInterface;

interface RetrieverInterface
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
