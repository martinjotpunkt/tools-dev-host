<?php

namespace AppBundle\Adapter;

use Component\Adapter\WebServerConfigAdapterInterface;
use Component\Model\VhostConfigInterface;
use Component\Renderer\ConfigRendererInterface;

class NginxConfigAdapter implements WebServerConfigAdapterInterface
{
    /** @var string */
    private $configDir;

    /** @var ConfigRendererInterface */
    private $renderer;


    /**
     * @param ConfigRendererInterface $renderer
     * @param string                  $configDir
     */
    public function __construct(ConfigRendererInterface $renderer, $configDir)
    {
        $this->renderer = $renderer;
        $this->configDir = $configDir;
    }


    /**
     * @param VhostConfigInterface $model
     * @param string               $filename
     */
    public function addConfigFile(VhostConfigInterface $model, $filename)
    {
        $config = $this->renderer->renderConfig([
            'config' => $model
        ]);

        $this->writeFile($filename, $config);
    }

    /**
     * @param string $filename
     */
    public function removeConfigFile($filename)
    {
        $path = $this->getFilePath($filename);
        if (file_exists($path)) {
            unlink($path);
        }
    }


    /**
     * @param string $name
     * @param string $data
     */
    private function writeFile($name, $data)
    {
        file_put_contents($this->getFilePath($name), $data);
    }


    /**
     * @param $name
     *
     * @return string
     */
    private function getFilePath($name)
    {
        return sprintf('%s%s.conf', $this->configDir, $name);
    }
}


