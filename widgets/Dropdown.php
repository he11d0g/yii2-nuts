<?php

namespace HD\yii\Nuts\widgets;

use Yii;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use HD\yii\Nuts\Elements;
use HD\yii\Nuts\Widget;

class Dropdown extends Widget
{

    /**
     * @var array
     */
    public $items = [];
    /**
     * @var array
     */
    public $titleOptions = [];
    /**
     * @var array
     */
    public $inputOptions = [];
    /**
     * @var bool
     */

    public $options = [];

    public $value = null;

    public $name = null;


    public function run()
    {
        $this->registerJs();
        Html::addCssClass($this->options, 'ui dropdown');

        echo Html::tag('div', $this->renderItems(), $this->options);
    }

    public function renderItems()
    {
        $out = Html::input('hidden',$this->name,$this->value,$this->inputOptions);
        $out .= Html::tag('div','',['class' => 'text']);
        $out .= Elements::icon('dropdown');
        $elems = '';
        foreach($this->items as $item){
            $elems .= $this->renderItem($item);
        }

        $out .= Html::tag('div',$elems,['class' => 'menu']);

        return $out;
    }

    public function renderItem($item)
    {
        $options = ArrayHelper::getValue($item, 'options');
        $options['data-value'] = ArrayHelper::getValue($item,'value');

        Html::addCssClass($options, 'item');

        return Html::tag('div', ArrayHelper::getValue($item, 'label'), $options);
    }

    public function registerJs()
    {
        $this->registerJsAsset();
        $clientOptions = $this->clientOptions ? Json::encode($this->clientOptions) : null;
        $this->getView()->registerJs('jQuery("#' . $this->options['id'] . '").dropdown(' . $clientOptions . ');');
    }

}
