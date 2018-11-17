<?php

namespace club\inlinesvg;

use Craft;
use craft\base\Plugin;
use club\inlinesvg\models\Settings;
use club\inlinesvg\services\InlineSvg as Service;

class InlineSvg extends Plugin
{
    public function init()
    {
        parent::init();

        $this->setComponents([
            'inlineSvg' => Service::class,
        ]);

        Craft::$app->view->registerTwigExtension(new InlineSvgTwigExtension);
    }

    protected function createSettingsModel()
    {
        return new Settings();
    }
}
