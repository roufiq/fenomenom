<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Fenomena */

$this->title = 'Update Fenomena: ' . $model->judul;
$this->params['breadcrumbs'][] = ['label' => 'Fenomenas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_fenomena, 'url' => ['view', 'id' => $model->id_fenomena]];
$this->params['breadcrumbs'][] = 'Update';
?>
<section class="content">
<div class="fenomena-update">
    <div class="box box-success">
        <div class="box-header with-border"
    <h1><?= Html::encode($this->title) ?></h1>
        </div>
    <div class="box-body">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    </div>

</div>

    </div>
</section>

