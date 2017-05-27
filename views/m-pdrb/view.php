<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MPdrb */

$this->title = $model->uraian_pdrb;
$this->params['breadcrumbs'][] = ['label' => 'Mpdrbs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mpdrb-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_pdrb], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_pdrb], [
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
            'id_pdrb',
            'uraian_pdrb',
        ],
    ]) ?>

</div>
