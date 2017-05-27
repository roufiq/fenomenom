<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MSubkategoriSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Master Subkategori PDRB';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="msubkategori-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Subkategori', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id_sub',
//            'id_pdrb',
            [   'attribute'=>'id_pdrb',
                'value'=>function($model)
                {
                    $jenisPdrb=\app\models\MPdrb::findOne(['id_pdrb'=>$model->id_pdrb])->uraian_pdrb;
                    return $jenisPdrb;
                },
                'group'=>true,


            ],
//            'id_kategori',
            [
                'attribute'=>'id_kategori',
                'value'=>function($model)
                {
                    $namaKat= \app\models\MKategoriPdrb::findOne(['id_kategori'=>$model->id_kategori])->kategori_pdrb;
                    return $namaKat;
                },
                'group'=>true,
            ],
            'nama_sub',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
