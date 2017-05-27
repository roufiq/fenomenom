<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use app\models\MPdrb;
/* @var $this yii\web\View */
/* @var $searchModel app\models\MKategoriPdrbSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Master Kategori PDRB';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mkategori-pdrb-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Master Kategori PDRB', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin();

?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id_kategori',
        [
            'attribute'=>'id_pdrb',
            'format'=>'text',
            'value'=>function($model)
            {
                return MPdrb::findOne($model->id_pdrb)->uraian_pdrb;
            },
            'group'=>true,

        ],
//            'id_pdrb',
            'kode_kategori',
            'kategori_pdrb',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
