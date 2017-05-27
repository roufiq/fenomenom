<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use vova07\imperavi\Widget;
use kartik\file\FileInput;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $model app\models\Fenomena */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="fenomena-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype'=>'multipart/form-data']
    ]); ?>

<!--tanggal buat, set today-->
    <?php
//    echo '<label>Tanggal Buat</label>';
//    echo DatePicker::widget([
//        'name' => 'date_created',
//        'value' => date('Y-m-d'),
//        'options' => ['placeholder' => 'Pilih Tanggal'],
//        'pluginOptions' => [
//            'format' => 'yyyy-mm-dd',
//            'todayHighlight' => true
//        ]
//    ]);
//
    ?>
    <?php
    echo $form->field($model, 'date_created')->widget(DatePicker::classname(), [
        'name' => 'date_created',
        'readonly'=>!$model->isNewRecord,
        'disabled'=>!$model->isNewRecord,
        'value' => date('Y-m-d'),
        'options' => ['placeholder' => 'Pilih Tanggal'],
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true,
            'autoclose'=>true,
        'options' => ['placeholder' => 'Set Tanggal'],
        ]
    ]);
    ?>

<!--    author baca login db, model-->


    <?= $form->field($model, 'judul')->textInput([
        'maxlength' => true,
//        'readonly' =>!$model->isNewRecord,
    ]) ?>

<!--    summary dari imperavi-->
    <?= $form->field($model, 'summary')->widget(Widget::className(),[
        'name'=> 'summary',
//        'value'=>function($model){
//          if($model->isNewRecord)
//              $text= '<p>Sumber:</p><hr><p>Deskripsi</p>';
//            else
//                $text= $model->summary;
//            return $text;
//        },
        'model'=>$model,
        'settings'=> [
            'lang' => 'id',
            'minHeight'=> 200,
            'plugins' => [
                'clips',
                'fullscreen'
            ]
        ]
    ]) ?>
<!--    -->
    <?//= Widget::widget(
//        [
//
//        ]
//    ) ?>


<!--    multipart upload-->


    <?php
    if(!isset($model->berkas)||trim($model->berkas)==='')
    {
        echo $form->field($model,'berkas')->widget(FileInput::classname(), [
            'options' => ['accept' => '*'
            ],
            'pluginOptions'=>['allowedFileExtensions'=>['pdf','png','jpg','jpeg','doc','docx','xls','xlsx'],'showUpload' => false,],

        ]);
    }
    else{
        $filePath='../uploads/'.$model->berkas;

        echo $form->field($model,'berkas')->widget(FileInput::classname(), [
            'options' => ['accept' => '*'],
            'pluginOptions'=>[
                'allowedFileExtensions'=>['pdf','png','jpg','jpeg','doc','docx','xls','xlsx'],
//                'showUpload' => true,
                'initialPreview'=>$filePath,
                'initialPreviewAsData'=>true,
                'initialCaption'=>$model->berkas,
                'overwriteInitial'=>true,
            ],
        ]);

    }


       ?>

    <?= $form->field($model, 'tag')->textInput(['maxlength' => true]) ?>

<!--    verifikasi status, hidden-->


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
