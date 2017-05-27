<?php
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

$form = ActiveForm::begin([
    'id'=>'form-signup',
    'options' => ['enctype'=>'multipart/form-data']]);
?>

<?= $form->field($model, 'username') ?>
<?= $form->field($model, 'email') ?>
<?= $form->field($model, 'password')->passwordInput() ?>
<?= $form->field($model, 'nama')?>
<?= $form->field($model, 'nip')?>
<?= $form->field($model, 'jabatan')?>
<?= $form->field($model,'photo')->widget(FileInput::classname(), [
            'options' => ['accept' => 'image'
            ],
            'pluginOptions'=>['allowedFileExtensions'=>['png','jpg','jpeg','gif'],'showUpload' => false,],

        ]) ?>

<div class="form-group"><?=\yii\helpers\Html::submitButton('Register',
    [
        'class'=>'btn btn-primary', 'name'=> 'signup-button'
    ])?>
</div>
<?php ActiveForm::end();
