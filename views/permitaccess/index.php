<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Akses';

?>
<div class="permit-access-index">

    <div class="row">
        <div class="col-sm-9">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-sm-3">
            <?= Html::a('<i class="fa fa-fw fa-plus-square"></i> Tambah Data', ['create'], ['class' => 'btn btn-success']) ?>
            <?= Html::a('<i class="fa fa-fw fa-book"></i> Cuti & Izin', ['/permit'], ['class' => 'btn btn-danger']) ?>
        </div>
    </div>

<div class="box"><div class="box-body"><div class="table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['attribute'=>'karyawan_id','value'=>'karyawan.nama'],
            'tipe_akses',
            [
                'attribute'=>'tanda_tangan',
                'format'=>'raw',
                'value'=>function($data){
                    if($data->tanda_tangan){
                        return '<a href="photos/tandatangan/'.$data->tanda_tangan.'"><i class="fa fa-fw fa-eye"></i></a>';
                    }
                }
            ],
            ['header'=>'Aksi','class' => 'yii\grid\ActionColumn','template'=>'{update}'],
        ],
    ]); ?>
</div></div></div>

</div>
