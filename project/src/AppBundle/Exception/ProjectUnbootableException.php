<?php

namespace AppBundle\Exception;

use Exception;

class ProjectUnbootableException extends \Exception implements TranslatableExceptionInterface
{
    const MESSAGE = 'api.error.project_unbootable';

    /** @var array */
    private $params = [];


    /**
     * @param string    $name
     * @param Exception $previous
     */
    public function __construct($name, Exception $previous = null)
    {
        $this->params = [
            '%name%' => $name,
        ];
        parent::__construct(self::MESSAGE, 501, $previous);
    }


    /**
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }
}
