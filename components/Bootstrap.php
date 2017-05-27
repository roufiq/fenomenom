<?php
namespace app\components;
use yii\base\BootstrapInterface;
use common\helpers\UrlRule;
class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        // Here you can refer to Application object through $app variable
//        $app->params['uploadPath'] = $app->basePath . '/uploads/';
//        $app->params['uploadUrl'] = $app->urlManager->baseUrl . '/uploads/';
    }
}

?>