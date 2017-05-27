<?php
use yii\helpers\Html;
use app\models\UserProfil;
use app\models\Fenomena;
//use Yii;

/* @var $this \yii\web\View */
/* @var $content string */

$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => '/fenomenom.ico']);
if (Yii::$app->controller->action->id === 'login' || Yii::$app->user->isGuest) {
/**
 * Do not use this code in your template. Remove it. 
 * Instead, use the code  $this->layout = '//main-login'; in your controller.
 */
    echo $this->render(
        'main-login',
        ['content' => $content]
    );
} else {

    if (class_exists('backend\assets\AppAsset')) {
        backend\assets\AppAsset::register($this);
    } else {
        app\assets\AppAsset::register($this);
    }
    $username = Yii::$app->user->identity->username;
    $model= UserProfil::findOne(['username'=>$username]);

    if($username=='admin')
    {
        $countA=Fenomena::find()->where(['is_verified'=>null])->count();
        $countV= Fenomena::find()->where(
            ['is_verified'=>1])->count();
    }
    else
    {
        $countA=  Fenomena::find()->where(['author'=>Yii::$app->user->getId()])->andWhere(['is_verified'=>null])->count();
        $countV = Fenomena::find()->where(['author'=>Yii::$app->user->getId()])->andWhere(['is_verified'=>1])->count();
    }




    dmstr\web\AdminLteAsset::register($this);

    $directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
    ?>
    <?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <link rel="shortcut icon" href="<?php echo Yii::$app->request->baseUrl; ?>/fenomenom.ico" type="image/x-icon" />
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="skin-green hold-transition sidebar-mini">
    <?php $this->beginBody() ?>


    <div class="wrapper">


        <?= $this->render(
            'header.php',
            ['directoryAsset' => $directoryAsset, 'model' =>$model]
        ) ?>

        <?= $this->render(
            'left.php',
            ['directoryAsset' => $directoryAsset, 'model' =>$model,'art'=>$countA,'ver'=>$countV]
        )
        ?>


        <?= $this->render(
            'content.php',
            ['content' => $content, 'directoryAsset' => $directoryAsset, 'model' =>$model]
        ) ?>

    </div>

    <?php $this->endBody() ?>
    </body>
    </html>
    <?php $this->endPage() ?>
<?php } ?>
