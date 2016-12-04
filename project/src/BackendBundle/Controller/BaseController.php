<?php
namespace BackendBundle\Controller;

use BackendBundle\Model\StatusModel;
use Component\Retriever\ProjectRetrieverInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Translation\TranslatorInterface;

abstract class BaseController extends Controller
{
    /**
     * @param string $status
     * @param string $message
     * @param array  $params
     *
     * @return JsonResponse
     */
    protected function createErrorResponse($status, $message, $params = [])
    {
        $status = $this->createStatusModel($status, $this->translate($message, $params));

        return $this->createJsonResponse($this->serialize($status));
    }

    /**
     * @param string $message
     * @param array  $params
     *
     * @return JsonResponse
     */
    protected function createSuccessResponse($message, $params = [])
    {
        $status = $this->createStatusModel(200, $this->translate($message, $params));

        return $this->createJsonResponse($this->serialize($status));
    }


    /**
     * @param mixed $data
     * @param int   $status
     *
     * @return JsonResponse
     */
    protected function createJsonResponse($data, $status = 200)
    {
        $headers = [
            'charset' => 'utf-8',
        ];

        return new JsonResponse($data, $status, $headers, true);
    }


    /**
     * @param object $data
     * @param string $format
     *
     * @return string
     */
    protected function serialize($data, $format = 'json')
    {
        return $this->getSerializer()
            ->serialize($data, $format);
    }


    /**
     * @param string $data
     * @param string $type
     *
     * @return object
     */
    protected function deserialize($data, $type)
    {
        return $this->getSerializer()->deserialize($data, $type, 'json');
    }


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
     * @return ProjectRetrieverInterface
     */
    protected function getProjectRetriever()
    {
        return $this->get('app.retriever.project');
    }


    /**
     * @return TranslatorInterface
     */
    private function getTranslator()
    {
        return $this->get('translator');
    }


    /**
     * @return SerializerInterface
     */
    private function getSerializer()
    {
        return $this->get('jms_serializer');
    }


    /**
     * @param $status
     * @param $message
     *
     * @return StatusModel
     */
    private function createStatusModel($status, $message)
    {
        return new StatusModel($status, $message);
    }
}
