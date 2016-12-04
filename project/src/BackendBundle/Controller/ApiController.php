<?php

namespace BackendBundle\Controller;

use BackendBundle\Exception\ProjectNotFoundException;
use BackendBundle\Exception\ProjectUnbootableException;
use BackendBundle\Exception\TranslatableExceptionInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ApiController extends BaseController
{
    /**
     * @return JsonResponse
     */
    public function indexProjectsAction()
    {
        return $this->createJsonResponse($this->serialize($this->getProjectRetriever()->findAll()));
    }


    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function bootProjectAction(Request $request)
    {
        $name = $request->get('name');

        try {
            $project = $this->getProjectRetriever()->findOne($name);
            if (is_null($project)) {
                throw new ProjectNotFoundException($name);
            }

            if(!$project->getCanBoot()) {
                throw new ProjectUnbootableException($name);
            }

            //docker build - < path:Dockerfile
            //

        } catch (TranslatableExceptionInterface $e) {
            return $this->createErrorResponse($e->getCode(), $e->getMessage(), $e->getParams());
        }

        return $this->createSuccessResponse('api.success.project_booted', [
            '%name%' => $name,
        ]);
    }
}
