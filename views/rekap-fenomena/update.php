<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RekapFenomena */

$this->title = 'Update Laju Pertumbuhan PDRB';
$this->params['breadcrumbs'][] = ['label' => 'Rekap Fenomenas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rekap-fenomena-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
