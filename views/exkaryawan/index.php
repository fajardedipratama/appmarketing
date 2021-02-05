<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Karyawan;
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

<div class="box"><div class="box-body"><div class="table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'badge',
                'value' => function($data){
                    $karyawan = Karyawan::find()->where(['id'=>$data->badge])->one();
                    return $karyawan['badge']; 
                }
            ],
            [
                'attribute' => 'nama_karyawan',
                'value' => function($data){
                    $karyawan = Karyawan::find()->where(['id'=>$data->badge])->one();
                    return $karyawan['nama']; 
                }
            ],
            'alasan',
            'tgl_resign',

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Aksi',
                'template' => '{update}'
            ],
        ],
    ]); ?>
</div></div></div>

</div>