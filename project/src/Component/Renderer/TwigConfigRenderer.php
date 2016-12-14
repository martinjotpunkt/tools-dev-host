<?php

namespace Component\Renderer;

use Twig_Environment;

class TwigConfigRenderer implements ConfigRendererInterface
{
    /** @var Twig_Environment */
    private $engine;

    /** @var string */
    private $template;


    /**
     * @param Twig_Environment $engine
     * @param string           $template
     */
    public function __construct(Twig_Environment $engine, $template)
    {
        $this->engine = $engine;
        $this->template = $template;
    }


    /**
     * @param array $context
     *
     * @return string|void
     */
    public function renderConfig(array $context)
    {
        return $this->engine->render($this->template, $context);
    }
}
