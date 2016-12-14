<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;

class DefaultController extends AbstractBaseController
{
    /**
     * @return Response
     */
    public function dashboardAction()
    {
        return $this->render('AppBundle:Default:index.html.twig', [
            'images' => $this->getImageRetriever()->findAll(),
            'projects' => $this->getProjectRetriever()->findAll(),
            'container' => $this->getContainerRetriever()->findAll(),
        ]);
    }
}
