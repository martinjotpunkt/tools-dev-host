<?php
namespace Component\Retriever;

use Docker\API\Model\Container;
use Docker\Docker;

class ContainerRetriever implements RetrieverInterface
{
    /**@var Docker */
    private $docker;


    /**
     * ProjectRetriever constructor.
     *
     * @param Docker $docker
     */
    public function __construct(Docker $docker)
    {
        $this->docker = $docker;
    }


    /**
     * @return Container[]
     */
    public function findAll()
    {
        return $this->docker->getContainerManager()->findAll();
    }


    /**
     * @param $name string
     *
     * @return Container
     */
    public function findOne($name)
    {
        return $this->docker->getContainerManager()->find($name);
    }
}
