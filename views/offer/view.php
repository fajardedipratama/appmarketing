<?php
use app\models\OfferExtra;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Offer */

$this->title = 'Detail Penawaran #'.$model->no_surat;
\yii\web\YiiAsset::register($this);
?>
<div class="offer-view">
    <div class="row">
        <div class="col-sm-8">
            <h1>
            <?php if(Yii::$app->user->identity->type == 'Marketing'): ?>
                <?= Html::a('<i class="glyphicon glyphicon-chevron-left"></i>', ['selfcustomer/view', 'id' => $model->perusahaan], ['class' => 'btn btn-success']) ?>
            <?php endif; ?>
                Detail Penawaran <b>#<?= $model->no_surat ?></b>
            </h1>
        </div>
        <div class="col-sm-4">
            <p>
            <?php if(Yii::$app->user->identity->type == 'Marketing'): ?>
                <?php if($model->status === 'Pending'): ?>
                <?= Html::a('<i class="fa fa-fw fa-pencil"></i> Ubah', ['update', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
                <?= Html::a('<i class="fa fa-fw fa-trash"></i> Hapus', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Hapus data ini ?',
                        'method' => 'post',
                    ],
                ]) ?>
                <?php endif; ?>
            <?php elseif(Yii::$app->user->identity->type == 'Administrator'): ?>
                <?= Html::a('<i class="fa fa-fw fa-print"></i> Cetak', ['print', 'id' => $model->id], ['target'=>'_blank','class' => 'btn btn-success']) ?>
                <?= Html::a('<i class="fa fa-fw fa-pencil"></i> Ubah', ['update', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
                <?= Html::a('<i class="fa fa-fw fa-trash"></i> Hapus', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Hapus data ini ?',
                        'method' => 'post',
                    ],
                ]) ?>
                <button class="btn btn-primary" data-toggle="modal" data-target="#extra-offer"><i class="fa fa-fw fa-plus-square"></i> Harga</button>
            <?php endif; ?>
            </p>
        </div>
    </div>

    <div class="table-responsive">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
              'label' => 'Waktu',
              'value' => function($data){
                return $data->tanggal.' '.$data->waktu;
              }
            ],
            'no_surat',
            [
              'attribute'=>'perusahaan',
              'format' => 'raw',
              'value'=>function($data){
                if(Yii::$app->user->identity->type == 'Marketing'){
                    return Html::a($data->customer->perusahaan, ['selfcustomer/view', 'id' => $data->perusahaan]);
                }else{
                    return Html::a($data->customer->perusahaan, ['customer/view', 'id' => $data->perusahaan]);
                }
              },
            ],
            'pic',
            'top',
            'pajak',
            'harga',
            'catatan',
            [
              'attribute'=>'sales',
              'value'=>function($data){
                return $data->karyawan->nama;
              },
            ],
            'status',
            [
                'attribute'=>'send_wa',
                'format'=>'raw',
                'value'=>function($data){
                    if($data->send_wa === 1){
                        return '<i class="fa fa-fw fa-check"></i>';
                    }else{
                        return ' ';
                    }
                },
            ],
            [
                'label'=>'Extra Harga',
                'format'=>'raw',
                'value'=> function($data){
                    $result=OfferExtra::find()->where(['offer_id'=>$data->id])->all();
                    $print = '';
                    foreach ($result as $show) {
                        $print .= $show->top.'/'.$show->harga.'/'.$show->pajak.' - ';
                    }
                    return $print;
                }
            ],
        ],
    ]) ?>   
    </div>

    <div class="modal fade" id="extra-offer"><div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>Tambah Harga</b></h4>          
            </div>
            <div class="modal-body">
              <?= $this->render('_formextra', ['model' => $model,'modelextra' => $modelextra]) ?>
            </div>
        </div>
    </div></div>

</div>
