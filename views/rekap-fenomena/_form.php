<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use yii\widgets\Pjax;

//$this->registerJs(
//    '$("document").ready(function(){
//        $("#pjax-form").on("pjax:end", function() {
//            $.pjax.reload({"container":"#pjax-gridview"});  //Reload GridView
//        });
//    });'
//);


/* @var $this yii\web\View */
/* @var $model app\models\RekapFenomena */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="rekap-fenomena-form">

    <?php
//    Pjax::begin(['id'=>'pjax-form','timeout'=>false]);
    $form = ActiveForm::begin([
        'options'=> ['data-pjax'=>true],
        'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]
    ]);
    ?>

    <?= $form->field($model, 'tahun')->textInput(['maxlength' => true, 'readonly'=>!$model->isNewRecord]) ?>

    <?= $form->field($model, 'triwulan')->textInput(['readonly'=>!$model->isNewRecord]) ?>
    <div class="col-sm-offset-3 col-sm-9"><div class="help-block"></div></div>

    <?php
    if($model->id_pdrb!=null)
    {
        $pdrb= \app\models\MPdrb::findOne(['id_pdrb'=>$model->id_pdrb])->uraian_pdrb;
        echo '<label class="control-label col-sm-3">'.'Jenis PDRB '.'</label>';
        echo '<label class="control-label col-sm-9">'.$pdrb.'</label>';
    }
    ?>
    <div class="col-sm-offset-3 col-sm-9"><div class="help-block"></div></div>

    <?php
    if($model->id_kategori!=null)
    {
        $kategori= \app\models\MKategoriPdrb::findOne(['id_kategori'=>$model->id_kategori])->kategori_pdrb;
        echo '<label class="control-label col-sm-3">'.'Kategori'.'</label>';
        echo '<label class="control-label col-sm-9">'.$kategori.'</label>';
    }

    ?>
    <div class="col-sm-offset-3 col-sm-9"><div class="help-block"></div></div>
    <?php
    if($model->id_subkategori!=null)
    {
        $sub_kategori= \app\models\MSubkategori::findOne(['id_sub'=>$model->id_subkategori])->nama_sub;
        echo '<label class="control-label col-sm-3">'.'Sub-kategori'.'</label>';
        echo '<label class="control-label col-sm-9">'.$sub_kategori.'</label>';
    }
    ?>
<!--    <div class="col-sm-offset-3 col-sm-9"><div class="help-block"></div></div>-->

    <?php
    $labelSeries='';
    if($model->series==1)
        $labelSeries='q to q';
    else if($model->series==2)
        $labelSeries=' Y on Y';
    else
        $labelSeries= 'Laju Implisit';

    if($model->id_pdrb==1)
    {
        echo Html::label('Series','series-judul',['class'=>'control-label col-sm-3']);
        echo Html::label($labelSeries,'series-nama',['class'=>'control-label col-sm-9']);
    }
    ?>
    <div class="col-sm-offset-3 col-sm-9"><div class="help-block"></div></div>

    <?php
    $p=[
        ['pertumbuhan'=>0, 'nama_pertumbuhan'=>'Turun'],
        ['pertumbuhan'=>1, 'nama_pertumbuhan'=>'Tetap'],
        ['pertumbuhan'=>2, 'nama_pertumbuhan'=>'Naik'],
    ];
    $pertumbuhanMap= \yii\helpers\ArrayHelper::map($p,'pertumbuhan','nama_pertumbuhan');
    ?>


    <?= $form->field($model, 'pertumbuhan')->dropDownList($pertumbuhanMap,['prompt'=>'Select...', 'options'=>[$model->pertumbuhan=>["Selected"=>true]]])?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?php
//    Pjax::end();

    ?>

</div>
