<?php

namespace Component\Model;

interface VhostConfigInterface
{

    /**
     * @return string
     */
    public function getName();


    /**
     * @return array
     */
    public function getPorts();

    /**
     * @param integer $guest
     * @param integer $host
     */
    public function addPort($guest, $host);
}
