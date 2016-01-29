# Yii2 Nuts
Набор красивых виджетов для Yii2

В Nuts используется css фреймворк  [Semantic UI][semantic]

> Расширение часто обновляется, 
> добавляются новые виджеты и функционал. Текущие возможности расширения, а также примеры использования можно посмотреть [тут][ext_url]


### Установка

У вас должен быть установлен [composer][composer_url]:

```sh
$ composer require he11d0g/yii2-nuts
```
Отключаем bootstrap. Для этого в конфигурационном файле добавляем строку в разделе components :

```
'assetManager' => [
            'bundles' => [
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'js'=>[]
                ],
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => []
                ]
            ]
        ],
```
А также в файле assets/AppAssets.php заменяем строку:
```
'yii\bootstrap\BootstrapAsset',
```
на
```
'HD\yii\Nuts\assets\NutsCSSAsset',
```
Примеры использования и инструкции можной посмотеть [тут][ext_url]


   [semantic]: <http://semantic-ui.com/>
   [ext_url]: <http://yii2-nuts.helldog.net>
   [composer_url]: <https://getcomposer.org/>
   


