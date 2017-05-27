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

    <!--    verifikasi status, hidden-->


<!--tanggal verifikasi-->
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

<!--    judul verifikasi -->
    <?= $form->field($model, 'judul_rev')->textInput(['maxlength' => true]) ?>

    <!--    Summary edit-->

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

<!--Tahun Data -->
    <?= $form->field($model, 'tahun')->textInput(['maxlength' => true]) ?>

    <?php
    if(!is_null($model->id_pdrb)&&!is_null($model->id_kategori_pdrb))
    {
//        echo Html::hiddenInput('id_pdrb', $model->id_pdrb, ['id'=>'id_pdrb']);
        echo Html::hiddenInput('kategori_pdrb_input', $model->id_kategori_pdrb, ['id'=>'kategori_pdrb_input']);
        if(!is_null($model->id_subkategori))
        {
            echo Html::hiddenInput('subkategori_input', $model->id_subkategori,['id'=>'subkategori_input']);
        }

    }
    ?>

<!--    Pilih Jenis PDRB-->




    <?= $form->field($model, 'id_pdrb')->dropDownList
    (\app\models\MPdrb::find()->select(['uraian_pdrb as uraian_pdrb'])
        ->indexBy('id_pdrb')->column(),['id'=>'fenomena-id_pdrb', 'prompt'=>'Select..']) ?>

<!--    Pilih Kategori PDRB-->

    <?php
    echo $form->field($model, 'id_kategori_pdrb')->widget(DepDrop::classname(), [
//        'type'=>DepDrop::TYPE_SELECT2,
        'options'=>['id'=>'fenomena-id_kategori_pdrb',],
//        'value'=>$model->id_kategori_pdrb,
        'pluginOptions'=>[
            'depends'=>['fenomena-id_pdrb'],
            'initialize'=>true,
            'initDepends'=>['fenomena-id_pdrb'],
            'url'=>Url::to(['/fenomena/kategori']),
            'placeholder'=>'Pilih Kategori..',
            'params'=>['kategori_pdrb_input'],
        ],
    ]);

    ?>
    <?php
    echo $form->field($model, 'id_subkategori')->widget(DepDrop::className(), [
        'options'=>['id'=> 'fenomena-id_subkategori'],
        'pluginOptions'=>[
            'depends'=>['fenomena-id_pdrb','fenomena-id_kategori_pdrb'],
            'initDepends'=>['fenomena-id_pdrb'],
            'url'=>Url::to(['/fenomena/subkategori']),
            'initialize'=>true,
            'params'=>['subkategori_input'],
        ],
    ]);
    ?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Verifikasi', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
