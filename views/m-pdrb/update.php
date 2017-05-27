<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MPdrb */

$this->title = 'Update Master PDRB: ' . $model->id_pdrb;
$this->params['breadcrumbs'][] = ['label' => 'Mpdrbs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_pdrb, 'url' => ['view', 'id' => $model->id_pdrb]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mpdrb-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
