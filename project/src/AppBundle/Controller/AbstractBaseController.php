<?php
namespace AppBundle\Controller;

use AppBundle\Helper\ContainerConfigHelper;
use AppBundle\Provider\ServerNameProvider;
use Component\Model\ProjectModelInterface;
use Component\Retriever\ContainerRetriever;
use Component\Retriever\ImageRetriever;
use Component\Retriever\RetrieverInterface;
use Docker\API\Model\Container;
use Docker\API\Model\Image;
use Docker\Docker;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Translation\TranslatorInterface;

abstract class AbstractBaseController extends Controller
{
    /**
     * @param string $token
     * @param array  $parameters
     *
     * @return string
     */
    protected function translate($token, $parameters = [])
    {
        return $this->getTranslator()->trans($token, $parameters);
    }


    /**
     * @return RetrieverInterface
     */
    protected function getProjectRetriever()
    {
        return $this->get('app.retriever.project');
    }


    /**
     * @return ContainerRetriever
     */
    protected function getContainerRetriever()
    {
        return $this->get('app.retriever.container');
    }


    /**
     * @return ImageRetriever
     */
    protected function getImageRetriever()
    {
        return $this->get('app.retriever.image');
    }


    /**
     * @return Docker
     */
    protected function getDocker()
    {
        return $this->get('app.docker');
    }


    /**
     * @return TranslatorInterface
     */
    private function getTranslator()
    {
        return $this->get('translator');
    }


    /**
     * @return ContainerConfigHelper
     */
    protected function getContainerConfigHelper()
    {
        return $this->get('app.helper.container');
    }


    /**
     * @return ServerNameProvider
     */
    protected function getServerNameProvider()
    {
        return $this->get('app.provider.server_name');
    }

    /**
     * @param $name
     *
     * @return ProjectModelInterface
     */
    protected function getProjectOr404($name)
    {
        $project = $this->getProjectRetriever()->findOne($name);

        if (!$project instanceof ProjectModelInterface) {
            throw new NotFoundHttpException;
        }

        return $project;
    }


    /**
     * @param $id
     *
     * @return ProjectModelInterface
     */
    protected function findContainerOr404($id)
    {
        $container = $this->getDocker()->getContainerManager()->find($id);

        if (!$container instanceof Container) {
            throw new NotFoundHttpException;
        }

        return $container;
    }


    /**
     * @param $id
     *
     * @return Image
     */
    protected function findImageOr404($id)
    {
        $image = $this->getDocker()->getImageManager()->find($id);

        if (!$image instanceof Image) {
            throw new NotFoundHttpException;
        }

        return $image;
    }


    /**
     * @return string
     */
    protected function getDashboardUrl()
    {
        return $this->generateUrl('app.dashboard');
    }
}
