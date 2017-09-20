<?php

namespace Component\Renderer;

interface ConfigRendererInterface
{
    /**
     * @param array $context
     *
     * @return string
     */
    public function renderConfig(array $context);
}
