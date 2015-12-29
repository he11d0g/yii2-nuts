<?php
namespace HD\yii\Nuts\widgets;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use HD\yii\Nuts\Elements;
use HD\yii\Nuts\Widget;

class Card extends Widget
{
    const STYLE_1 = 1;
    const STYLE_2 = 2;
    const STYLE_3 = 3;
    const STYLE_4 = 4;

    public $imageSrc = '';
    public $style = 1;
    public $topContent = '';
    public $bottomContent = '';
    public $header = '';
    public $meta = '';
    public $description = '';
    public $extraContent = '';

    public $metaOptions = [];
    public $descriptionOptions = [];
    public $contentOptions = [];
    public $extraContentOptions = [];

    public function run()
    {
        $this->registerJs();
        $content = '';
        switch($this->style){
            case self::STYLE_1:
                $content = $this->renderStyleOne();
                break;
            case self::STYLE_2:
                break;
            case self::STYLE_3:
                break;
            case self::STYLE_4:
                break;
        }

        echo Html::tag('div', $content, $this->options);
    }

    public function renderStyleOne()
    {
        $content = '';
        if($this->imageSrc){
            $content .= $this->renderImage();
        }

        $content .= $this->renderContent();

        if($this->extraContent){
            $content .= $this->renderExtraContent();
        }


        return Html::tag('div',$content,$this->options);
    }

    public function renderExtraContent()
    {
        Html::addCssClass($this->extraContentOptions, 'extra content');

        return Html::tag('div', $this->extraContent, $this->extraContentOptions);
    }

    public function renderContent()
    {
        Html::addCssClass($this->contentOptions, 'content');

        $content = $this->renderHeader();
        $content .= $this->renderMeta();
        $content .= $this->renderDescription();

        return Html::tag('div', $content, $this->contentOptions);
    }

    public function renderHeader()
    {
        return Html::tag('div', $this->header, ['class' => 'header']);
    }

    public function renderMeta()
    {
        Html::addCssClass($this->metaOptions, 'meta');
        $content = Html::tag('span',$this->meta,['class' => 'date']);

        return Html::tag('div', $content, $this->metaOptions);
    }

    public function renderDescription()
    {
        Html::addCssClass($this->descriptionOptions, 'description');

        return Html::tag('div', $this->description, $this->descriptionOptions);
    }

    public function renderImage()
    {
        $content = Html::img($this->imageSrc, $this->imgOptions);

        return Html::tag('div',$content,['class' => 'image']);
    }

    public function registerJs()
    {
        $this->registerJsAsset();
        $options = $this->clientOptions ? Json::encode($this->clientOptions) : null;
        $this->getView()->registerJs('jQuery("#' . $this->options['id'] . '").card(' . $options . ');');
    }
}