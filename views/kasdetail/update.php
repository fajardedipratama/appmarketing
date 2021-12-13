<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\KasDetail */

$this->title = 'Update Kas Detail: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Kas Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="kas-detail-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
