<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use vova07\imperavi\Widget;
use kartik\file\FileInput;
use kartik\widgets\DepDrop;
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
        'readonly' =>!$model->isNewRecord,
    ]) ?>

<!--    summary dari imperavi-->
    <?= $form->field($model, 'summary')->widget(Widget::className(),[
        'name'=> 'summary',
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
<!--    --><?//= Widget::widget(
//        [
//
//        ]
//    ) ?>


<!--    multipart upload-->


    <?php
    if(!is_null($model->berkas))
    {
        $filePath='../uploads/'.$model->berkas;

        echo $form->field($model,'berkas')->widget(FileInput::classname(), [
            'options' => ['accept' => '*'],
            'disabled'=>true,
            'pluginOptions'=>[
                'allowedFileExtensions'=>['pdf','png','jpg','jpeg','doc','docx','xls','xlsx'],
//                'showUpload' => true,
                'initialPreview'=>$filePath,
                'initialPreviewAsData'=>true,
                'overwriteInitial'=>true,

            ],
        ]);
    }
    else{
        echo $form->field($model,'berkas')->widget(FileInput::classname(), [
            'options' => ['accept' => '*'
            ],
            'pluginOptions'=>['allowedFileExtensions'=>['pdf','png','jpg','jpeg','doc','docx','xls','xlsx'],'showUpload' => false,],

        ]);
    }

//     echo $form->field($model, 'berkas')->widget(FileInput::classname(), [
//        'options'=>['accept'=>'*'],
//        'pluginOptions'=>['allowedFileExtensions'=>['pdf','jpg','gif','png'],
//        ]]);

       ?>

    <?= $form->field($model, 'tag')->textInput(['maxlength' => true]) ?>

<!--    verifikasi status, hidden-->
    <?= $form->field($model, 'is_verified')->textInput([
        'visible'=>$model->isNewRecord,

    ]) ?>


    <?php
    echo $form->field($model, 'date_verified')->widget(DatePicker::classname(), [
        'name' => 'date_created',
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
    <?= $form->field($model, 'judul_rev')->textInput(['maxlength' => true]) ?>


<!--    SUmmarry edit-->

    <?= $form->field($model, 'summary_rev')->widget(Widget::className(),[
        'name'=> 'summary_rev',
        'model'=>$model,
        'settings'=> [
            'lang' => 'id',
            'minHeight'=> 200,
            'plugins' =>
                [
                'clips',
                'fullscreen',
                ]
        ]
    ]) ?>


<!--    create triwulan form array-->
    <?php
        $triwulan = [
            ['triwulan'=>1, 'nama_triwulan'=>'Triwulan I'],
            ['triwulan'=>2, 'nama_triwulan'=>'Triwulan II'],
            ['triwulan'=>3, 'nama_triwulan'=>'Triwulan III'],
            ['triwulan'=>4, 'nama_triwulan'=>'Triwulan IV'],
        ];
        $triwulan_data = ArrayHelper::map($triwulan,'triwulan','nama_triwulan');
    ?>
    <?= $form->field($model, 'triwulan')->dropDownList($triwulan_data,['prompt'=> 'Pilih triwulan']) ?>


    <?= $form->field($model, 'tahun')->textInput(['maxlength' => true]) ?>

    <?php
    $pdrb = \app\models\MPdrb::find()->all();
    $listData = ArrayHelper::map($pdrb, 'id_pdrb', 'uraian_pdrb');
    ?>


    <?= $form->field($model, 'id_pdrb')->dropDownList($listData,['id'=>'id_pdrb', 'prompt'=>'Select..']) ?>


    <?php
//    if(!$model->isNewRecord)
//    {
//        echo Html::hiddenInput('id_kategori_pdrb',$model->id_kategori_pdrb,['id'=>'id_kategori_pdrb']);
//        echo Html::hiddenInput('id_subkategori',$model->id_subkategori,['id'=>'id_subkategori']);
//
//    }


    echo $form->field($model, 'id_kategori_pdrb')->widget(DepDrop::classname(), [
        'type'=>DepDrop::TYPE_SELECT2,
//        'data'=>[$model->id_kategori_pdrb=>\app\models\MKategoriPdrb::findOne($model->id_kategori_pdrb)->kategori_pdrb],
//        'options'=>['id'=>$model->id_kategori_pdrb, 'placeholder'=>'Pilih Kategori..'],
        'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
        'pluginOptions'=>[
            'depends'=>['id_pdrb'],
            'url'=>Url::to(['/fenomena/kategori']),
            'initialize'=>true,
            'params'=>['id_kategori_pdrb'],
        ],
    ]);

    echo $form->field($model, 'id_subkategori')->widget(DepDrop::className(), [
        'type'=>DepDrop::TYPE_SELECT2,
//        'data'=>[$model->id_kategori_pdrb=>\app\models\MKategoriPdrb::findOne($model->id_kategori_pdrb)->kategori_pdrb],
//        'options'=>['id'=>$model->id_subkategori, 'placeholder'=>'Pilih Kategori..',],
        'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
        'pluginOptions'=>[
            'depends'=>['id_pdrb', 'id_kategori_pdrb'],
            'url'=>Url::to(['/fenomena/subkategori']),
            'initialize'=>true,
            'params'=>['id_subkategori'],
        ],
    ]);


    ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Verifikasi', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
