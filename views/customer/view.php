<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Customer */

$this->title = $model->perusahaan;

\yii\web\YiiAsset::register($this);
?>
<div class="customer-view">
    <div class="row">
        <div class="col-sm-7">
            <h2><b><?= Html::encode($this->title) ?></b></h2>
        </div>
        <div class="col-sm-5">
            <p>
                <?= Html::a('<i class="fa fa-fw fa-plus-square"></i> Tambah Data', ['create'], ['class' => 'btn btn-success']) ?>
                <?= Html::a('<i class="fa fa-fw fa-list"></i> Data', ['index'], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('<i class="fa fa-fw fa-pencil"></i> Ubah', ['update', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
                <?= Html::a('<i class="fa fa-fw fa-trash"></i> Hapus', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Hapus data ini ?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>
        </div>
    </div>
    
    <div class="table-responsive">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'perusahaan',
            [
              'attribute'=>'lokasi',
              'value'=>function($data){
                return $data->city->kota;
              },
            ],
            'alamat_lengkap',
            'pic',
            'telfon',
            'email:email',
            'catatan',
        ],
    ]) ?>
    </div>
</div>
