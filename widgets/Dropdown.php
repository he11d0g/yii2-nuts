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

    const STYLE_SELECTION = 'selection';
    const STYLE_SELECTION_SEARCH = 'selection search';
    const STYLE_NONE = '';
    const STYLE_SEARCH = 'search';

    /**
     * @var string
     */
    public $loading = false;
    /**
     * @var string
     */
    public $style = self::STYLE_SELECTION;
    /**
     * @var array
     */
    public $items = [];
    /**
     * @var array
     */
    public $inputOptions = [];
    /**
     * @var bool
     */
    public $options = [];
    /**
     * @var bool
     */
    public $value = null;
    /**
     * @var bool
     */
    public $name = null;


    public function run()
    {
        $this->registerJs();
        Html::addCssClass($this->options, 'ui dropdown');
        if($this->style){
            Html::addCssClass($this->options, $this->style);
        }
        if($this->loading){
            Html::addCssClass($this->options, 'loading');
        }

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
        $icon = ArrayHelper::getValue($item,'icon');
        $tag = ArrayHelper::getValue($item,'tag');
        $body = $icon ? '<i class="'.$icon.' icon"></i>'. ArrayHelper::getValue($item, 'label') : ArrayHelper::getValue($item, 'label');
        Html::addCssClass($options, 'item');

        return Html::tag( $tag ?: 'div' , $body , $options);
    }

    public function registerJs()
    {
        $this->registerJsAsset();
        $clientOptions = $this->clientOptions ? Json::encode($this->clientOptions) : null;
        $this->getView()->registerJs('jQuery("#' . $this->options['id'] . '").dropdown(' . $clientOptions . ');');
    }

}
