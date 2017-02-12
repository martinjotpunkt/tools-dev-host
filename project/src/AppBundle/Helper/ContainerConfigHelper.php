<?php
namespace AppBundle\Helper;

use AppBundle\Model\VhostConfigModel;
use AppBundle\Provider\ServerNameProviderInterface;
use ArrayObject;
use Component\Adapter\WebserverConfigAdapterInterface;
use Component\Model\ProjectModelInterface;
use Component\Model\VhostConfigInterface;
use Docker\API\Model\Container;
use Docker\API\Model\ContainerConfig;
use Docker\API\Model\ContainerCreateResult;
use Docker\API\Model\HostConfig;
use Docker\API\Model\Image;
use Docker\API\Model\PortBinding;
use Docker\Docker;
use Docker\Manager\ContainerManager;
use Psr\Http\Message\ResponseInterface;

class ContainerConfigHelper
{
    /** @var Docker */
    private $docker;

    /** @var WebserverConfigAdapterInterface */
    private $webServerAdapter;

    /** @var ServerNameProviderInterface */
    private $nameProvider;


    /**
     * @param Docker                          $docker
     * @param WebserverConfigAdapterInterface $webServerAdapter
     * @param ServerNameProviderInterface     $nameProvider
     */
    public function __construct(Docker $docker, WebserverConfigAdapterInterface $webServerAdapter, ServerNameProviderInterface $nameProvider)
    {
        $this->docker = $docker;
        $this->webServerAdapter = $webServerAdapter;
        $this->nameProvider = $nameProvider;
    }


    /**
     * @param ProjectModelInterface $project
     * @param array                 $expose
     *
     * @return Container|ContainerCreateResult|ResponseInterface
     */
    public function run(ProjectModelInterface $project, array $expose = [])
    {
        $image = $this->docker->getImageManager()->find($project->getName());
        $container = $this->createContainer($image, $project, $expose);

        if ($container instanceof ContainerCreateResult) {
            $this->startContainer($container);
        }

        $container = $this->startContainer($container);
        $config = $this->createVhostConfig($container, $project, $expose);

        $this->extendConfiguration($config, $container->getName());

        return $container;
    }


    /**
     * @param Image                 $image
     * @param ProjectModelInterface $project
     * @param array                 $exposed
     *
     * @return ContainerCreateResult|ResponseInterface
     */
    private function createContainer(Image $image, ProjectModelInterface $project, array $exposed = [])
    {
        $config = new ContainerConfig();
        $config->setImage($image->getId());
        $config->setHostConfig($this->getHostConfiguration($image, $project, $exposed));

        return $this->getContainerManager()->create($config);
    }


    /**
     * @param ContainerCreateResult $container
     *
     * @return Container
     */
    private function startContainer(ContainerCreateResult $container)
    {
        $this->getContainerManager()->start($container->getId());

        return $this->getContainerManager()->find($container->getId());
    }


    /**
     * @param Image                 $image
     * @param ProjectModelInterface $project
     * @param array                 $publicPorts
     *
     * @return HostConfig
     */
    private function getHostConfiguration(Image $image, ProjectModelInterface $project, array $publicPorts = [])
    {
        $host = new HostConfig();
        $forwardable = $this->extractForwardablePorts($image->getContainerConfig()->getExposedPorts());
        $bindings = $this->createPortBinding($forwardable, $publicPorts);

        if (!empty($bindings)) {
            $host->setPortBindings($bindings);
        }

        $host->setBinds([sprintf('%s:/var/www/project', $project->getPath().'/project')]);

        return $host;
    }


    /**
     * @param ArrayObject $ports
     *
     * @return array
     */
    private function extractForwardablePorts(ArrayObject $ports)
    {
        return array_filter(iterator_to_array($ports->getIterator()), function ($port) {
            return '22/tcp' !== $port;
        });
    }


    /**
     * @param array $ports
     * @param array $public
     *
     * @return array
     */
    private function createPortBinding(array $ports, array $public = [])
    {
        $bindings = [];

        foreach ($public as $port) {
            if (array_key_exists($port, $ports)) {
                $bindings[$port] = [(new PortBinding())->setHostPort('')];
            }
        }

        return $bindings;
    }


    /**
     * @param Container             $container
     * @param ProjectModelInterface $project
     * @param array                 $public
     *
     * @return VhostConfigModel
     */
    private function createVhostConfig(Container $container, ProjectModelInterface $project, array $public = [])
    {
        $config = new VhostConfigModel($this->nameProvider->getServerName($project->getName()));
        $ports = $container->getNetworkSettings()->getPorts();

        if (!is_null($ports)) {
            $ports = array_filter(iterator_to_array($ports->getIterator()), function($content) {
                return is_array($content);
            });
        } else {
            $ports = [];
        }

        foreach ($ports as $exposed => $bindings) {
            if (in_array($exposed, $public)) {
                $clean = str_replace('/tcp', '', $exposed);

                /** @var PortBinding[] $bindings */
                foreach ($bindings as $binding) {
                    $config->addPort($clean, $binding->getHostPort());
                }
            }
        }

        return $config;
    }


    /**
     * @param VhostConfigInterface $config
     * @param string               $name
     */
    private function extendConfiguration(VhostConfigInterface $config, $name)
    {
        $this->webServerAdapter->addConfigFile($config, $name);
    }


    /**
     * @return ContainerManager
     */
    private function getContainerManager()
    {
        return $this->docker->getContainerManager();
    }
}
