<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MPdrb */

$this->title = 'Create Master PDRB';
$this->params['breadcrumbs'][] = ['label' => 'Mpdrbs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mpdrb-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
