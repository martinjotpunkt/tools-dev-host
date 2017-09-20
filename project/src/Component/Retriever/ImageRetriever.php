<?php
namespace Component\Retriever;

use Docker\API\Model\Image;
use Docker\Docker;

class ImageRetriever implements RetrieverInterface
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
     * @return Image[]
     */
    public function findAll()
    {
        return $this->docker->getImageManager()->findAll();
    }


    /**
     * @param $name string
     *
     * @return Image
     */
    public function findOne($name)
    {
        return $this->docker->getImageManager()->find($name);
    }
}
