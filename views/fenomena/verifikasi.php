<?php
/**
 * Created by PhpStorm.
 * User: Moh Roufiq Azmy
 * Date: 4/23/2017
 * Time: 9:51 PM
 */
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Fenomena */

$this->title = 'Verifikasi Fenomena';

$this->params['breadcrumbs'][] = ['label' => 'Fenomenas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_fenomena, 'url' => ['view', 'id' => $model->id_fenomena]];
$this->params['breadcrumbs'][] = 'Verifikasi';
?>
<div class="fenomena-verifikasi">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_verif', [
        'model' => $model,
    ]) ?>

</div>