<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FenomenaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fenomena-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_fenomena') ?>

    <?= $form->field($model, 'date_created') ?>

    <?= $form->field($model, 'author') ?>

    <?= $form->field($model, 'judul') ?>

    <?= $form->field($model, 'summary') ?>

    <?php // echo $form->field($model, 'berkas') ?>

    <?php // echo $form->field($model, 'tag') ?>

    <?php // echo $form->field($model, 'is_verified') ?>

    <?php // echo $form->field($model, 'date_verified') ?>

    <?php // echo $form->field($model, 'judul_rev') ?>

    <?php // echo $form->field($model, 'summary_rev') ?>

    <?php // echo $form->field($model, 'triwulan') ?>

    <?php // echo $form->field($model, 'tahun') ?>

    <?php // echo $form->field($model, 'id_pdrb') ?>

    <?php // echo $form->field($model, 'id_kategori_pdrb') ?>

    <?php // echo $form->field($model, 'id_subkategori') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
