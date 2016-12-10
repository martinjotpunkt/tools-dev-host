<?php

namespace AppBundle\Model;

use Component\Model\VhostConfigInterface;
use Doctrine\Common\Collections\ArrayCollection;

class VhostConfigModel implements VhostConfigInterface
{
    /** @var string */
    private $name;

    /** @var ArrayCollection */
    private $ports;


    public function __construct($name)
    {
        $this->name = $name;
        $this->ports = new ArrayCollection();
    }


    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }


    /**
     * @return ArrayCollection
     */
    public function getPorts()
    {
        return $this->ports;
    }


    /**
     * @param integer $guest
     * @param integer $host
     */
    public function addPort($guest, $host)
    {
        $this->ports->add($this->createPort($guest, $host));
    }


    /**
     * @param integer $guest
     * @param integer $host
     *
     * @return array
     */
    private function createPort($guest, $host)
    {
        return [
            'guest' => $guest,
            'host' => $host,
        ];
    }
}
