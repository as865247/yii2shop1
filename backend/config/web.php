<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2017/11/6
 * Time: 16:19
 */

$config = [
    'id' => 'my-app',
    'components' => [
    ]
];
Yii::$container->set('leandrogehlen\treegrid\TreeGridAsset',[
    'js' => [
        'js/jquery.cookie.js',
        'js/jquery.treegrid.min.js',
    ]
]);
return $config;