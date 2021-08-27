<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\AttendancedataSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Attendance Datas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attendance-data-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Attendance Data', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'karyawan_id',
            'work_day',
            'work_date',
            'schedule_in',
            //'schedule_out',
            //'real_in',
            //'real_out',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
