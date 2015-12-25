<?php
/**
 * Author: helldog
 * Email: im@helldog.net
 * Url: http://helldog.net
 */
namespace HD\yii\Nuts\assets;

use Yii;
use yii\web\AssetBundle;

class NutsCSSAsset extends AssetBundle
{
    /**
     * @var string
     */
    public $sourcePath = '@vendor/bower/semantic/dist';

    public function init()
    {
        $this->css[] = 'semantic.min.css';
        parent::init();
    }
}