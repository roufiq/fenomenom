<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RekapFenomena */

$this->title = 'Create Rekap Fenomena';
$this->params['breadcrumbs'][] = ['label' => 'Rekap Fenomenas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rekap-fenomena-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
