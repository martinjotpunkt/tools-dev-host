<?php

namespace AppBundle\Controller;

use Psr\Http\Message\ResponseInterface;
use Symfony\Component\HttpFoundation\Response;

class ContainerController extends AbstractBaseController
{

    /**
     * @param $name
     *
     * @return Response
     */
    public function runAction($name)
    {
        $project = $this->getProjectOr404($name);
        $this->getContainerConfigHelper()->run($project, ['80/tcp']);

        return $this->redirect($this->getDashboardUrl());
    }


    /**
     * @param $id
     *
     * @return ResponseInterface
     */
    public function killAction($id)
    {
        $container = $this->findContainerOr404($id);

        $this->get('app.adapter.nginx')->removeConfigFile($container->getName());

        $this->getDocker()->getContainerManager()->kill($id);

        return $this->redirect($this->getDashboardUrl());
    }
}
