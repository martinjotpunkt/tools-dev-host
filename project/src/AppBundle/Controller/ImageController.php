<?php

namespace AppBundle\Controller;

use Docker\API\Model\BuildInfo;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ImageController extends AbstractBaseController
{
    /**
     * @param string $name
     *
     * @return array
     * @throws \Exception
     */
    public function buildAction($name)
    {
        return $this->render('AppBundle:Default:show_build_info.html.twig', [
            'steps' => $this->parseBuildInfo($this->buildProjectImage($name)),
        ]);
    }


    /**
     * @param $id
     *
     * @return RedirectResponse
     */
    public function removeAction($id)
    {
        $image = $this->findImageOr404($id);
        $id = $image->getId();
        $id = substr($id, strpos($id, ':') + 1, 12);

        $this->getDocker()->getImageManager()->remove($id, [
            'force' => true,
        ]);

        return $this->redirect($this->getDashboardUrl());
    }



    /**
     * @param string $name
     *
     * @return BuildInfo[]
     * @throws \Exception
     */
    private function buildProjectImage($name)
    {
        $project = $this->getProjectOr404($name);
        $params = [
            't' => strtolower($project->getName())
        ];

        return $this->getDocker()->getImageManager()->build($project->getContext()->toStream(), $params);
    }


    /**
     * @param BuildInfo[] $buildInfo
     *
     * @return array
     */
    private function parseBuildInfo(array $buildInfo)
    {
        return array_map(function(BuildInfo $info) {
            $error = $info->getError();

            if (!empty($error)) {
                return $error;
            }

            return $info->getStream();
        }, $buildInfo);
    }
}
