<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ExkaryawanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Exkaryawans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exkaryawan-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Exkaryawan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'badge',
            'alasan',
            'tgl_resign',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
