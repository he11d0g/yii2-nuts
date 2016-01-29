<?php

namespace HD\yii\Nuts\widgets;

use Yii;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use HD\yii\Nuts\Elements;
use HD\yii\Nuts\Widget;

class Checkbox extends Widget
{
    const STYLE_SLIDER = 'slider';
    const STYLE_TOGGLE = 'toggle';


    /**
     * @var string
     *
     */
    public $style = '';
    /**
     * @var string
     */
    public $label = '';
    /**
     * @var array
     */
    public $inputOptions = [];
    /**
     * @var array
     */
    public $options = [];
    /**
     * @var bool
     */
    public $isDisabled = false;
    /**
     * @var bool
     */
    public $isActive = false;
    /**
     * @var bool
     */
    public $isReadOnly = false;
    /**
     * @var string
     */
    public $value = null;
    /**
     * @var string
     */
    public $name = null;


    public function run()
    {
        $this->registerJs();

        switch($this->style){
            case self::STYLE_SLIDER :
                Html::addCssClass($this->options, self::STYLE_SLIDER);
                break;
            case self::STYLE_TOGGLE :
                Html::addCssClass($this->options, self::STYLE_TOGGLE);
                break;
        }

        if($this->isDisabled){
            Html::addCssClass($this->options, 'disabled');
            $this->inputOptions['disabled'] = 'disabled';
        }

        if($this->isActive){
            Html::addCssClass($this->options, 'checked');
            $this->inputOptions['checked'] = '';
        }

        if($this->isReadOnly){
            Html::addCssClass($this->options, 'read-only');
        }

        Html::addCssClass($this->options, 'ui checkbox');
        $body = Html::input('checkbox',$this->name,$this->value,$this->inputOptions);
        $body .= Html::tag('label',$this->label);

        echo Html::tag('div', $body, $this->options);
    }

    public function registerJs()
    {
        $this->registerJsAsset();
        $clientOptions = $this->clientOptions ? Json::encode($this->clientOptions) : null;
        $this->getView()->registerJs('jQuery("#' . $this->options['id'] . '").checkbox(' . $clientOptions . ');');
    }

}
