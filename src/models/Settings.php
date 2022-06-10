<?php

namespace club\inlinesvg\models;

use craft\base\Model;

class Settings extends Model
{
    public $paths = [];
    public $class = '';

    public function rules(): array
    {
        return [
            ['paths', 'required'],
            ['class', 'required'],
        ];
    }
}
