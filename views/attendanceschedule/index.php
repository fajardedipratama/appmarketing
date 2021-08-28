<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Jadwal Kerja';

?>
<div class="attendance-schedule-index">

    <div class="row">
        <div class="col-sm-10">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-sm-2">
            <?= Html::a('<i class="fa fa-fw fa-clock-o"></i> Absensi Harian', ['attendancedata/index'], ['class' => 'btn btn-success']) ?>
        </div>
    </div>

<div class="box"><div class="box-body"><div class="table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'hari',
            [
                'header'=>'Jam Kerja',
                'value'=>function($data){
                    return $data->jam_masuk.' - '.$data->jam_pulang;
                }
            ],
            'status',
            [
                'header'=>'Aksi','class' => 'yii\grid\ActionColumn',
                'template'=>'{update}'
            ],
        ],
    ]); ?>
</div></div></div>

</div>
