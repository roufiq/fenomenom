<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\tabs\TabsX;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RekapFenomenaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tabulasi Rekap Fenomena';
$this->params['breadcrumbs'][] = $this->title;
//$this->
$items = [
    [
        'label'=>'<i class="glyphicon glyphicon-tag"></i>  PDRB Menurut Lapangan Usaha',
        'content'=>$this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]),
        'active'=>true
    ],
    [
//        <i class="glyphicon glyphicon-info-sign"></i>
        'label'=>'<i class="glyphicon glyphicon-tags"></i>     PDRB Menurut Pengeluaran ',
        'content'=>$this->render('//fenomena/index',
            [
            'searchModel' => $searchModel2,
            'dataProvider' => $dataProvider2,
            ]),

    ],
//    [
//        'label'=>'<i class="glyphicon glyphicon-list-alt"></i> Dropdown',
//        'items'=>[
//            [
//                'label'=>'Option 1',
//                'encode'=>false,
//                'content'=>$content3,
//            ],
//            [
//                'label'=>'Option 2',
//                'encode'=>false,
//                'content'=>$content4,
//            ],
//        ],
//    ],
//    [
//        'label'=>'<i class="glyphicon glyphicon-king"></i> Disabled',
//        'headerOptions' => ['class'=>'disabled']
//    ],
];

echo TabsX::widget([
    'items'=>$items,
    'position'=>TabsX::POS_ABOVE,
    'encodeLabels'=>false
]);


?>

