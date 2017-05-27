<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Json;
use yii\bootstrap\Alert;
use yii\helpers\ArrayHelper;
use kartik\grid\DataColumn;
use kartik\widgets\AlertBlock;
use app\assets\FontsAsset;

FontsAsset::register($this);
/* @var $this yii\web\View */
/* @var $searchModel app\models\RekapFenomenaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>
<section class="content-header">
    <?php
    $param = Yii::$app->request->getQueryParam('RekapFenomenaSearch');
    $tahunParam = $param['tahun'];
    $triwulanParam = $param['triwulan'];
    $pdrbParam = $param['id_pdrb'];

    ($pdrbParam == 1) ? $this->title = 'Rekapitulasi Fenomena Perekonomian PDRB Menurut Lapangan Usaha' :
        $this->title = 'Rekapitulasi Fenomena Perekonomian PDRB Menurut Pengeluaran';
    $this->params['breadcrumbs'][] = $this->title;

    ?>
</section>

<section class="content">
    <?php
    //    echo Alert::widget([
    //        'options' => ['class' => 'alert-success'],
    //        'body' => Yii::$app->session->getFlash('success'),
    //    ]);
    ?>
    <div class="rekap-fenomena-index">

        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><?= $this->title ?></h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                        <i class="fa fa-minus"></i></button>
                </div>
            </div>


            <div class="box-body">
                <?php
                echo AlertBlock::widget([
                    'type' => AlertBlock::TYPE_ALERT,
                    'useSessionFlash' => true
                ]);
                ?>
                <?php


                $gridColumns = [
//                ['class'=>'kartik\grid\SerialColumn'],
//                'id',
//                'tahun',
//                'triwulan',
//                'id_pdrb',
                    [
                        'attribute' => 'kode_kategori',
                        'visible' => ($pdrbParam == 1),
                        'format' => 'text',
                        'label' => 'Kode',
                        'value' => function ($model) {
                            $kode_kategori = \app\models\MKategoriPdrb::findOne($model->id_kategori)->kode_kategori;
                            return $kode_kategori;
                        },
                        'group' => true,
                        'hAlign' => GridView::ALIGN_CENTER,
                        'vAlign' => GridView::ALIGN_MIDDLE,
                    ],
                    [
                        'attribute' => 'uraian',
                        'format' => 'html',
                        'headerOptions' => ['style' => 'width:30%'],
                        'value' => function ($model) {
                            $uraian = '';
                            if ($model->id_subkategori != null) {
//                            $q=\app\models\MSubkategori::findOne($model->id_subkategori)->nama_sub;
                                $uraian = \app\models\MSubkategori::findOne($model->id_subkategori)->nama_sub;
                            } else {
                                $q = \app\models\MKategoriPdrb::findOne($model->id_kategori)->kategori_pdrb;
                                $uraian = '<span class="text-bold">' . $q . '</span>';
                            }
                            return $uraian;
                        },
                        'group' => true,
                    ],
//                'id_kategori',
//                'id_subkategori' ,
                    [
                        'attribute' => 'series',
                        'format' => 'text',
                        'visible' => ($pdrbParam == 1),

                        'value' => function ($model) {
                            $nama_series = '';
                            if ($model->series == 1)
                                $nama_series = 'q to q';
                            else if ($model->series == 2)
                                $nama_series = 'Y on Y';
                            else
                                $nama_series = 'Laju implisit';
                            return $nama_series;
                        },
                        'noWrap' => true,
                        'hAlign' => GridView::ALIGN_CENTER,

                    ],
//                'pertumbuhan',
                    [
                        'attribute' => 'pertumbuhan',
                        'noWrap' => true,
                        'class' => 'kartik\grid\EditableColumn',
                        'editableOptions' => [
                            'header' => 'Pertumbuhan',
                            'asPopover' => true,
                            'showAjaxErrors' => false,
//                        'formOptions'=>['action' => ['/rekap=fenomena/editpertumbuhan']],
                            // point to the new action

                            'inputType' => \kartik\editable\Editable::INPUT_DROPDOWN_LIST,
                            'data' => [0 => 'Turun', 1 => 'Tetap', 2 => 'Naik'],
//                        'options' => ['class'=>'form-control', 'placeholder'=>'Enter person name...']
                            'options' => ['class' => 'form-control', 'prompt' => 'Select status...'],
                            'displayValueConfig' => [
                                '0' => '<span class="text-red"><i class="glyphicon glyphicon-triangle-bottom"></i> Turun</span>',
                                '1' => '<span class="text-black "><i class="glyphicon glyphicon-minus"></i> Tetap</span>',
                                '2' => '<span class="text-green"><i class="glyphicon glyphicon-triangle-top"></i> Naik</span>',

                            ],
                        ],
                        'format' => 'html',
                        'value' => function ($model) {
                            $pertumbuhan = '';
                            if ($model->id_pdrb == 1 || (!\app\models\MSubkategori::find()->where(['id_kategori' => $model->id_kategori])->exists() || $model->id_subkategori != null)) {
                                if ($model->pertumbuhan == 1)
                                    $pertumbuhan = '<span class="text-black "><i class="glyphicon glyphicon-minus"></i> Tetap</span>';
                                else if ($model->pertumbuhan == 0)
                                    $pertumbuhan = '<span class="text-red"><i class="glyphicon glyphicon-triangle-bottom"></i> Turun</span>';
                                else
                                    $pertumbuhan = '<span class="text-green"><i class="glyphicon glyphicon-triangle-top"></i> Naik</span>';
                            }
                            return $pertumbuhan;
                        },
                        'contentOptions' => function ($model, $key, $index, $column) {
                            return ['style' => 'background-color:'
                                . ($model->id_pdrb == 1 || (!\app\models\MSubkategori::find()->where(['id_kategori' => $model->id_kategori])->exists() ||
                                    $model->id_subkategori != null)
                                    ? 'white' : 'black')];
                        },
//                    'editableSuccess'=>
                    ],

//                'series' ,
                    [
                        'attribute' => 'daftar_fenomena',
                        'format' => 'raw',
                        'group' => ($pdrbParam == 1),
//                'encode'=>true,
                        'value' => function ($model) {
                            $id_pdrb = $model->id_pdrb;
                            $id_kategori = $model->id_kategori;
                            $id_subkategori = $model->id_subkategori;
                            if (isset($_GET['tahun-drop'])) {
                                $tahun = $_GET['tahun-drop'];
                            } else {
                                $tahun = $model->tahun;
                            }
                            if (isset($_GET['triwulan-drop'])) {
                                $triwulan = $_GET['triwulan-drop'];
                            } else {
                                $triwulan = $model->triwulan;
                            }
//                    $triwulan= $model->triwulan;
                            $fenomenas = \app\models\Fenomena::find()->where(['id_pdrb' => $id_pdrb])
                                ->andWhere(['id_kategori_pdrb' => $id_kategori])
                                ->andWhere(['id_subkategori' => $id_subkategori])
                                ->andWhere(['tahun' => $tahun])
                                ->andWhere(['triwulan' => $triwulan])
                                ->asArray()->all();
                            $daftar = '';
                            if (sizeof($fenomenas) != 0) {
                                foreach ($fenomenas as $fenomena) {
                                    $textLink = $fenomena['judul_rev'].'<br>'. $fenomena['summary_rev'];
                                    $daftar .= Html::a($textLink, ['fenomena/view', 'id' => $fenomena['id_fenomena']],
                                            ['target' => '_blank', 'data-pjax' => 0]
                                        )
                                        . '<br>';
                                }
//                        $daftar= Html::decode($daftar);
                            } else {
                                $daftar = '-';
                            }
                            return $daftar;


                        },
                        'contentOptions' => function ($model, $key, $index, $column) {
                            return ['style' => 'background-color:'
                                . ($model->id_pdrb == 1 || (!\app\models\MSubkategori::find()->where(['id_kategori' => $model->id_kategori])->exists() ||
                                    $model->id_subkategori != null)
                                    ? 'white' : 'black')];
                        }
                    ],
//                ['class' => 'kartik\grid\ActionColumn',
//                    'template'=>'{update}',
//                    'buttons'=>[
//                        'update'=>function ($url, $model){
//                            if ($model->id_pdrb==1||(!\app\models\MSubkategori::find()->where(['id_kategori'=>$model->id_kategori])->exists()||$model->id_subkategori!=null))
//                            {
//                             return Html::a('<span class="glyphicon glyphicon-pencil"></span>',$url);
//                            }
//                            else return '';
//
//                        }
//                    ],
//                    'contentOptions'=>function ($model, $key, $index, $column){
//                        return ['style' => 'background-color:'
//                            . ($model->id_pdrb==1||(!\app\models\MSubkategori::find()->where(['id_kategori'=>$model->id_kategori])->exists()||
//                                $model->id_subkategori!=null)
//                                ? 'white' : 'grey')];
//                    }
//
//                ],


                ];
                $toolbar =
                    [
                        '{sort}',
                        [
                            'content' => '',
                        ],
                        '{export}',
                        '{toggleData}',


                    ];
                ?>

                <div class="col-md-6">


                    <?php
                    echo '<label class="control-label">Tahun</label>';
                    //            echo \kartik\select2\Select2::widget([
                    //                'name' => 'tahun_list',
                    //                'value' => '',
                    //                'data' => $listTahun,
                    //                'options' => ['multiple' => false, 'placeholder' => 'Pilih Tahun..']
                    //            ]);
                    $data = ArrayHelper::map(\app\models\MTahun::find()->all(), 'tahun_data', 'tahun_data');
                    echo Html::dropDownList('tahun', null, $data, ['prompt' => '- select tahun-',
//                'onchange'=>'$.pjax.reload({url: "'.Url::to(['index']).'?RekapFenomenaSearch[tahun]="+$(this).val(),
//        container: "#pjax-gridview",
//        timeout: 1000,
//        });     ',
                        'class' => 'form-control', 'id' => 'tahun-drop',
                        'options' => [
                            $tahunParam => ['selected' => true],
                        ]]);
                    //            Triwulan
                    $triwulan = [
                        ['triwulan' => 1, 'nama_triwulan' => 'Triwulan I'],
                        ['triwulan' => 2, 'nama_triwulan' => 'Triwulan II'],
                        ['triwulan' => 3, 'nama_triwulan' => 'Triwulan III'],
                        ['triwulan' => 4, 'nama_triwulan' => 'Triwulan IV'],
                    ]; ?>
                </div>

                <div class="col-md-6">
                    <?php
                    $triwulan_data = ArrayHelper::map($triwulan, 'triwulan', 'nama_triwulan');

                    echo '<label class="control-label">Triwulan</label>';
                    //            Belum bisa ambil parameter URL buat javascript sementara diakalin

                    if ($pdrbParam == 1)
                        echo Html::dropDownList('triwulan', null, $triwulan_data, ['prompt' => '- select triwulan-',
//                'onchange'=>'$.pjax.reload({url: "'.Url::to(['index']).'?RekapFenomenaSearch[triwulan]="+$.base64.encode($(this).val(),
                                'onchange' => '$.pjax.reload({url: "' . Url::to(['index']) . '?RekapFenomenaSearch[id_pdrb]=1&RekapFenomenaSearch[tahun]="+$("#tahun-drop option:selected").text()+"&RekapFenomenaSearch[triwulan]="+$(this).val(),
        container: "#pjax-gridview",
        timeout: 1000,
    });
',
                                'class' => 'form-control', 'id' => 'triwulan-drop',
                                'options' => [
                                    $triwulanParam => ['selected' => true],
                                ]]

                        );
                    else
                        echo Html::dropDownList('triwulan', null, $triwulan_data, ['prompt' => '- select triwulan-',
//                'onchange'=>'$.pjax.reload({url: "'.Url::to(['index']).'?RekapFenomenaSearch[triwulan]="+$.base64.encode($(this).val(),
                                'onchange' => '$.pjax.reload({url: "' . Url::to(['index']) . '?RekapFenomenaSearch[id_pdrb]=2&RekapFenomenaSearch[tahun]="+$("#tahun-drop option:selected").text()+"&RekapFenomenaSearch[triwulan]="+$(this).val(),
        container: "#pjax-gridview",timeout: 1000,});',
                                'class' => 'form-control', 'id' => 'triwulan-drop',
                                'options' => [
                                    $triwulanParam => ['selected' => true],
                                ]]

                        );
                    ?>
                </div>
                <div class="col-md-4 col-sm-3 col-xs-1"><br>

                </div>

                <div class="col-lg-12">


                <?php
                //            buat Pjax disin
//                            Pjax::begin(['timeout'=>5000,'id'=>'pjax-gridview']);
                echo GridView::widget([
                    'id'=>'gridview-rekap',
                    'dataProvider' => $dataProvider,
//                'filterModel' => $searchModel,
                    'columns' => $gridColumns,
                    'panel' => [
//                    'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-globe"></i> '. Html::encode($this->title).'</h3>',
                        'type' => 'primary',
                        'showFooter' => false,
                        'responsive'=>true,
                        'condensed'=>true,
                        'refreshGrid'=>true,

                    ],
//                'floatHeader'=>true,
//                'floatHeaderOptions'=>['scrollingTop'=>'10'],
                    'pjax' => true,
                    'pjaxSettings' => [
                        'neverTimeout' => true,
                        'options' => [
                            'id' => 'pjax-gridview'],
//                        'beforeGrid'=>'My fancy content before.',
//                        'afterGrid'=>'My fancy content after.',

                    ],
                    'exportConfig' => [
                        GridView::CSV => ['label' => 'Save as CSV'],
                        GridView::EXCEL => ['label' => 'Save as Excel'],
                    ],
                    'toggleDataOptions' =>
                        [
                            'all' => [
                                'icon' => 'resize-full',
                                'label' => 'All',
                                'class' => 'btn btn-default',
                                'title' => 'Show all data'
                            ],
                            'page' => [
                                'icon' => 'resize-small',
                                'label' => 'Page',
                                'class' => 'btn btn-default',
                                'title' => 'Show first page data'
                            ],
                        ],

                ]);


//                            Pjax::end();

                ?>
                </div>
            </div>

        </div>


    </div>


</section>