<?php

namespace newism\assetrev\models;

class Settings extends \craft\base\Model
{
    public $manifestPath;
    public $assetUrlPrefix;

    public function rules()
    {
        return [];
    }
}
