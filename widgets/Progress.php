<?php

namespace HD\yii\Nuts\widgets;

use Yii;
use yii\helpers\Html;
use HD\yii\Nuts\Elements;
use HD\yii\Nuts\Widget;

class Progress extends Widget
{
    /**
     * @var string
     */
    public $label = '';
    /**
     * @var string
     */
    public $progressLabel = '';
    /**
     * @var array
     */
    public $options = [];
    /**
     * @var bool
     */
    public $active = false;
    /**
     * @var bool
     */
    public $autoHide = false;
    /**
     * @var array
     */
    public $indicating = false;
    /**
     * @var array
     */
    public $ajax = [];
    /**
     * @var string
     */
    public $value = null;
    /**
     * @var string
     */
    public $id = null;
    /**
     * @var integer
     */
    public $percent = 0;

    public function run()
    {
        $this->registerJs();
        Html::addCssClass($this->options, 'ui progress');

        $this->options['data-percent'] = $this->percent;

        if($this->active){
            Html::addCssClass($this->options, 'active');
        }


        if($this->indicating){
            Html::addCssClass($this->options, 'indicating');
        }

        if($this->autoHide && !$this->percent){
            Html::addCssStyle($this->options, 'display: none');
        }

        $body = Html::beginTag('div',['class' => 'bar']);
        $body .= Html::tag('div',$this->progressLabel,['class' =>'progress']);
        $body .= Html::endTag('div');
            $body .= Html::tag('div',$this->label,['class' => 'label']);

        if($this->ajax){
            $this->registerAjax();
        }

        echo Html::tag('div', $body, $this->options);
    }

    public function registerJs()
    {
        $this->registerJsAsset();
        $clientOptions = $this->clientOptions ? Json::encode($this->clientOptions) : null;
        $this->getView()->registerJs('jQuery("#' . $this->options['id'] . '").progress(' . $clientOptions . ');');
    }

    public function registerAjax()
    {
        $url = isset($this->ajax['url']) ? $this->ajax['url'] : '#';
        $method = isset($this->ajax['method']) ? $this->ajax['method'] : 'post';
        $interval = isset($this->ajax['interval']) ? $this->ajax['interval'] : '30000';
        $data = isset($this->ajax['data']) ? json_encode($this->ajax['data']) : '{}';

        $autoHide = $this->autoHide
            ? 'if(jQuery.isEmptyObject(data)){
                    jQuery("#' . $this->options['id'] . '").css("display","none");
                } else {
                    jQuery("#' . $this->options['id'] . '").css("display","block");
                }'
            : '';

        $func = 'jQuery.ajax({
            url: "'.$url.'",
            method: "'.$method.'",
            data: '.$data.',
            success: function(data){
                var data = JSON.parse(data);
                jQuery("#' . $this->options['id'] . '").progress(data);
                '.$autoHide.'
            }
        })';
        $script = $func.'setInterval(function(){'.$func.'},'.$interval.')';
        $this->getView()->registerJs($script);
    }

}
