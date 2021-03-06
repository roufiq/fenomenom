<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MSubkategoriSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="msubkategori-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_sub') ?>

    <?= $form->field($model, 'id_pdrb') ?>

    <?= $form->field($model, 'id_kategori') ?>

    <?= $form->field($model, 'nama_sub') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
