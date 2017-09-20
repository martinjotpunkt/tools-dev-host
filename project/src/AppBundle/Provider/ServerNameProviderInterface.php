<?php

namespace AppBundle\Provider;

interface ServerNameProviderInterface
{
    /**
     * @param string $subDomain
     *
     * @return string
     */
    public function getServerName($subDomain);
}
