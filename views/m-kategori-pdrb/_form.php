<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\MPdrb;

/* @var $this yii\web\View */
/* @var $model app\models\MKategoriPdrb */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mkategori-pdrb-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
        $pdrb = MPdrb::find()->all();
        $listData = ArrayHelper::map($pdrb, 'id_pdrb', 'uraian_pdrb');

    ?>
    <?= $form->field($model, 'id_pdrb')->dropDownList($listData,['prompt'=> 'Pilih jenis PDRB']) ?>

    <?= $form->field($model, 'kode_kategori')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'kategori_pdrb')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
