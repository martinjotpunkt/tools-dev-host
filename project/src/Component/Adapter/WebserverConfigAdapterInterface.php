<?php

namespace Component\Adapter;

use Component\Model\VhostConfigInterface;

interface WebserverConfigAdapterInterface
{
    /**
     * @param VhostConfigInterface $model
     * @param string               $filename
     */
    public function addConfigFile(VhostConfigInterface $model, $filename);


    /**
     * @param string $filename
     */
    public function removeConfigFile($filename);
}


