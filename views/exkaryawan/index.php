<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ExkaryawanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ex-Karyawan';

?>
<div class="exkaryawan-index">

    <div class="row">
        <div class="col-sm-10">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-sm-2">
            <?= Html::a('<i class="fa fa-fw fa-users"></i> Karyawan Aktif', ['/karyawan'], ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'badge',
            'alasan',
            'tgl_resign',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
