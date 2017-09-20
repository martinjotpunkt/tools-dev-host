<?php

namespace AppBundle\Provider;

class ServerNameProvider implements ServerNameProviderInterface
{
    /** @var string */
    private $host;


    /**
     * @param string $host
     */
    public function __construct($host)
    {
        $this->host = $host;
    }


    /**
     * @param string $subDomain
     *
     * @return string
     */
    public function getServerName($subDomain)
    {
        return sprintf('%s.%s', $subDomain, $this->host);
    }
}
