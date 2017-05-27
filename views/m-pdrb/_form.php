<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MPdrb */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mpdrb-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'uraian_pdrb')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
