<?php
namespace AppBundle\Model;

use Component\Model\ProjectModelInterface;
use Docker\Context\ContextInterface;

class ProjectModel implements ProjectModelInterface
{
    /** @var string */
    private $name;

    /** @var string */
    private $path;

    /** @var ContextInterface */
    private $context;


    public function __construct($name, $path, ContextInterface $context)
    {
        $this->name = $name;
        $this->path = $path;
        $this->context = $context;
    }


    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }


    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }


    /**
     * @return ContextInterface
     */
    public function getContext()
    {
        return $this->context;
    }

    public function delete()
    {
        $this->deleteRecursively($this->getPath());
    }

    private function deleteRecursively($dir) {
       $files = array_diff(scandir($dir), ['.', '..']);

        foreach ($files as $file) {
            $path = $dir . '/' . $file;

            if (is_dir($path)) {
                $this->deleteRecursively($path);
            } else {
                unlink($path);
            }
        }

        return rmdir($dir);
      }
}
