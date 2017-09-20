<?php
namespace AppBundle\Exception;

use Exception;

class ProjectNotFoundException extends \Exception implements TranslatableExceptionInterface
{
    const MESSAGE = 'api.error.project_not_found';

    private $params = [];

    public function __construct($name)
    {
        $this->params = [
            '%name%' => $name,
        ];

        parent::__construct(self::MESSAGE, 404);
    }


    public function getParams()
    {
        return $this->params;
    }
}
