<?php

namespace Component\Adapter;

use Component\Model\VhostConfigInterface;

interface WebServerConfigAdapterInterface
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


