<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MKategoriPdrb */

$this->title = 'Update Master Kategori PDRB: ' . $model->id_kategori;
$this->params['breadcrumbs'][] = ['label' => 'Mkategori Pdrbs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_kategori, 'url' => ['view', 'id' => $model->id_kategori]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mkategori-pdrb-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
