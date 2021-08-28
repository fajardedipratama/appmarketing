<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\AttendancedataSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Absensi Harian';

?>
<div class="attendance-data-index">

    <div class="row">
        <div class="col-sm-10">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-sm-2">
        <?php if(Yii::$app->user->identity->type == 'Administrator'): ?>
            <?= Html::a('<i class="fa fa-fw fa-calendar"></i> Jadwal Kerja', ['attendanceschedule/index'], ['class' => 'btn btn-success']) ?>
        <?php endif; ?>
        </div>
    </div>
<div class="box"><div class="box-body"><div class="table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['header'=>'Tanggal'],
            ['header'=>'Karyawan'],
            ['header'=>'Jadwal'],
            ['header'=>'Absensi'],

            ['header'=>'Aksi','class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div></div></div>

</div>
