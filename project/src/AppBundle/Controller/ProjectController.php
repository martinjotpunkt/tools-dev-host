<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;

class ProjectController extends AbstractBaseController
{
    /**
     * @param $name
     *
     * @return Response
     */
    public function deleteAction($name)
    {
        $project = $this->getProjectOr404($name);

        $project->delete();

        return $this->redirect($this->getDashboardUrl());
    }
}
