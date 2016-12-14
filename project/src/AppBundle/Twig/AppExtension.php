<?php
namespace AppBundle\Twig;

class AppExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('shortHash', array($this, 'getShortHash')),
        );
    }

    public function getShortHash($hash, $length = 12, $prefix = '#')
    {
        $colon = strpos($hash, ':');

        if (-1 !== $colon) {
            $hash = substr($hash, $colon + 1);
        }

        $hash = $prefix . substr($hash, 0, $length);

        return $hash;
    }

    public function getName()
    {
        return 'app_extension';
    }
}
