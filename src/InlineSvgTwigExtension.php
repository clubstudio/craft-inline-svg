<?php

namespace club\inlinesvg;

use Twig_Extension;
use Twig_SimpleFunction;

class InlineSvgTwigExtension extends Twig_Extension
{
    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'Inline SVG';
    }

    /**
     * Get Twig Functions.
     *
     * @return array
     */
    public function getFunctions()
    {
        return [
            new Twig_SimpleFunction('inlineSvg', [$this, 'inlineSvg']),
        ];
    }

    /**
     * Inline the contents of an SVG file.
     *
     * @param  string $name
     * @param  mixed  $class
     * @param  array  $params
     * @return string
     */
    public function inlineSvg($name, $class = null, $params = [])
    {
        return InlineSvg::getInstance()->inlineSvg->render($name, $class, $params);
    }
}
