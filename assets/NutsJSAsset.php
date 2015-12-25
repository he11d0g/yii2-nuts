<?php
/**
 * Author: helldog
 * Email: im@helldog.net
 * Url: http://helldog.net
 */
namespace HD\yii\Nuts\assets;

use Yii;
use yii\web\AssetBundle;

class NutsJSAsset extends AssetBundle
{
    /**
     * @var string
     */
    public $sourcePath = '@vendor/bower/semantic/dist';
    /**
     * @var array
     */
    public $depends = [
        'yii\web\JqueryAsset',
        'HD\yii\Nuts\assets\NutsCSSAsset'
    ];
    public function init()
    {
        $this->js[] = 'semantic.min.js';
        parent::init();
    }
}