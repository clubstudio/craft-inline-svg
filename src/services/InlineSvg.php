<?php

namespace club\inlineSvg\services;

use Craft;
use Exception;
use craft\base\Model;
use craft\base\Component;
use craft\elements\Asset;
use craft\helpers\Template as TemplateHelper;

class InlineSvg extends Component
{
    /**
     * The file extension to be applied to file names.
     *
     * @var string
     */
    const EXTENSION = '.svg';

    /**
     * Configuration options.
     *
     * @var array
     */
    protected $config;

    /**
     * Create a new instance
     */
    public function __construct()
    {
        $this->config = \club\inlinesvg\InlineSvg::getInstance()->getSettings();
    }

    /**
     * Render the inline SVG file.
     *
     * @param  string $file
     * @param  mixed  $class
     * @param  array  $params
     * @return string
     */
    public function render($file, $class = null, $params = [])
    {
        if (is_array($class)) {
            $params = $class;
            $class = '';
        }

        $params = array_merge([
            'class' => $this->renderClasses($class),
        ], $params);

        $fileContents = $this->getFileContents($this->resolveFile($file), $params);

        return TemplateHelper::raw(
            str_replace('<svg', sprintf('<svg%s', $this->renderAttributes($params)), $fileContents)
        );
    }

    /**
     * Resolve an SVG from the provided file.
     *
     * @param  string $file
     * @return string
     */
    protected function resolveFile($file)
    {
        if ($file instanceof Asset) {
            return $file;
        }

        foreach ($this->config['paths'] as $path) {
            $path = rtrim($path, '/') . '/';
            $fullPath = Craft::getAlias($path . $file . self::EXTENSION);

            if (file_exists($fullPath)) {
                return $fullPath;
            }
        }

        return $file . self::EXTENSION;
    }

    /**
     * Get the contents of the SVG file.
     *
     * @param  string $file
     * @param  array  $params
     * @return string
     */
    protected function getFileContents($file, $params = [])
    {
        $nativeSvg = Craft::$app->view->twig->getFunction('svg')->getCallable();

        return $nativeSvg(
            $file,
            isset($params['sanitize']) and $params['sanitize'],
            $params['namespace'] ?? null
        );
    }

    /**
     * Renders a list of classes to be applied to the generated SVG.
     *
     * @param  string $class
     * @return string
     */
    protected function renderClasses($class)
    {
        return trim(sprintf('%s %s', $this->config['class'], $class));
    }

    /**
     * Render the attributes to be applied to the generated SVG.
     *
     * @param  array $attributes
     * @return string
     */
    protected function renderAttributes($attributes)
    {
        $attributes = array_diff_key($attributes, ['sanitize' => '', 'namespace' => '']);

        if (count($attributes) < 1) {
            return '';
        }

        $attrs = array_map(function ($attribute, $value) {
            return is_string($value) ? sprintf('%s="%s"', $attribute, $value) : $attribute;
        }, array_keys($attributes), $attributes);

        return ' ' . implode(' ', $attrs);
    }
}
