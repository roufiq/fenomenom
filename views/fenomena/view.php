<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\imagine\Image;
use app\models\Fenomena;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Fenomena */

$this->title = $model->id_fenomena;
$this->params['breadcrumbs'][] = ['label' => 'Fenomenas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fenomena-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_fenomena], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_fenomena], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_fenomena',
            'date_created',
            'author',
            'judul',
            'summary:ntext',
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
            'is_verified',
            'date_verified',
            'judul_rev',
            'summary_rev:ntext',
            'triwulan',
            'tahun',
            'id_pdrb',
            'id_kategori_pdrb',
            'id_subkategori',
        ],
    ]) ?>




</div>

