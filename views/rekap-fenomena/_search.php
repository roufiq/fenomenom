<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RekapFenomenaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rekap-fenomena-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tahun') ?>

    <?= $form->field($model, 'triwulan') ?>

    <?= $form->field($model, 'id_pdrb') ?>

    <?= $form->field($model, 'id_kategori') ?>

    <?php // echo $form->field($model, 'id_subkategori') ?>

    <?php // echo $form->field($model, 'series') ?>

    <?php // echo $form->field($model, 'pertumbuhan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
