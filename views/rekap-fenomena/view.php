<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\RekapFenomena */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Rekap Fenomenas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rekap-fenomena-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'tahun',
            'triwulan',
            'id_pdrb',
            'id_kategori',
            'id_subkategori',
            'series',
            'pertumbuhan',
        ],
    ]) ?>

</div>
