<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\DailyreportSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dailyreports';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dailyreport-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Dailyreport', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'sales',
            'waktu',
            'perusahaan',
            'keterangan',
            //'volume',
            //'jarak_ambil',
            //'catatan',
            //'pengingat',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
