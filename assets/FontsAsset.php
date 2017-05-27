<?php
/**
 * Created by PhpStorm.
 * User: Moh Roufiq Azmy
 * Date: 4/29/2017
 * Time: 5:49 PM
 */

 namespace app\assets;

 use yii\web\AssetBundle;

 /**
  * @author Qiang Xue <qiang.xue@gmail.com>
  * @since 2.0
  */
 class FontsAsset extends AssetBundle
 {
     public $basePath = '@webroot';
     public $baseUrl = '@web';
     public $css = [
         'css/site.css',
         'css/fonts.css',
     ];
     public $js = [
         'js/jquery.base64.js',
         'js/jquery.base64.min.js',
     ];
     public $depends = [
         'yii\web\YiiAsset',
         'yii\bootstrap\BootstrapAsset',
     ];
 }