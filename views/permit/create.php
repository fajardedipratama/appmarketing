<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Permit */

$this->title = 'Create Permit';
$this->params['breadcrumbs'][] = ['label' => 'Permits', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permit-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
