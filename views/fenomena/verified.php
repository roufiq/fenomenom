<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use app\models\Fenomena;
use yii\helpers\Url;
use app\models\User;
/* @var $this yii\web\View */
/* @var $searchModel app\models\FenomenaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar Fenomena Terverifikasi';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fenomena-index">

    <h1></h1>

<?php Pjax::begin();

?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'panel'=>[
            'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-globe"></i> '. Html::encode($this->title).'</h3>',
            'type'=>'primary',
            'showFooter'=>false,
        ],
        'exportConfig' => [
            GridView::CSV => ['label' => 'Save as CSV'],
            GridView::EXCEL=> ['label' => 'Save as Excel'],
                ],
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn',
                'vAlign'=> GridView::ALIGN_TOP],

//            'id_fenomena',
            [
                'attribute'=>'date_created',
                'format'=>['date','dd-MMM-yyyy']
            ],
            [
                'attribute'=>'author',
                'format'=>'text',
                'value'=>function($model)
                {
                    return User::findOne($model->author)->username;
                }

            ],
            [
                'attribute'=>'judul_rev',
                'format'=> 'html',
            ],

            [
                'attribute'=>'summary_rev',
                'format'=>'html',

            ],
//             'berkas',
            [
              'attribute'=>'berkas',
                'format'=>'raw',
                'value'=> function($model)
                {
//                    Yii::$app->params['uploadPath'] = '/uploads/';
                    $fileName = Fenomena::findOne($model->id_fenomena)->berkas;
                    if($fileName<>"")
                    {
                        $link=  Yii::$app->request->baseUrl.'/uploads/'.$fileName;
                        $anchor= Html::a(Html::tag('div',
                            Html::tag('i', '', ['class' => 'fa fa-upload fa-fw']) . 'File'
                        ), Url::to($link),[
                            'target'=>'_blank',
                            'data-pjax'=>0
                        ]);
                        return $anchor;
                    }
                    else return "";
//                    echo Html::a($link,['site/index']);
                }
            ],
             'tag',
//             'is_verified',
            // 'date_verified',
            // 'judul_rev',
            // 'summary_rev:ntext',
//             'triwulan',
//             'tahun',
            // 'id_pdrb',
            // 'id_kategori_pdrb',
            // 'id_subkategori',

            ['class' => 'kartik\grid\ActionColumn',
                'template'=> '{view} {update} {delete} {verifikasi}',
                'buttons'=> [
                    'verifikasi' => function ($url, $model, $key){
                        return Html::a('<span class="glyphicon glyphicon-info-sign"></span>', ['verifikasi', 'id'=>$model->id_fenomena]);
                    },
                ],
            ],

        ],
        'toolbar' => [
            '{export}',
//            '{toggleData}'
        ]

    ]); ?>
    <?php
//    echo ExportMenu::widget([
//        'dataProvider' => $dataProvider,
//        'columns' => $gridColumns,
//        'columnSelectorOptions'=>[
//            'label' => 'Columns',
//            'class' => 'btn btn-danger'
//        ],
//        'fontAwesome' => true,
//        'dropdownOptions' => [
//            'label' => 'Export All',
//            'class' => 'btn btn-primary'
//        ],
//            'exportConfig' => [
//        ExportMenu::FORMAT_HTML => false,
//        ExportMenu::FORMAT_TEXT => false,
//    ],
//        ]);
    ?>
<?php Pjax::end(); ?></div>
