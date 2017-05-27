<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserProfil */

$this->title = 'Update User Profil: ' . $model->nip;
$this->params['breadcrumbs'][] = ['label' => 'User Profils', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nip, 'url' => ['view', 'id' => $model->nip]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-profil-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
