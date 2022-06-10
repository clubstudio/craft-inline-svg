<?php

namespace club\inlinesvg;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class InlineSvgTwigExtension extends AbstractExtension
{
    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName(): string
    {
        return 'Inline SVG';
    }

    /**
     * Get Twig Functions.
     *
     * @return array
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('inlineSvg', [$this, 'inlineSvg'], ['is_safe' => ['html']]),
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
    public function inlineSvg($name, $class = null, $params = []): string
    {
        return InlineSvg::getInstance()->inlineSvg->render($name, $class, $params);
    }
}
