<?php
use app\models\OfferExtra;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Offer */

function round_up($number, $precision = 2)
{
    $fig = pow(10, $precision);
    return (ceil($number * $fig) / $fig);
}

$this->title = 'Detail Penawaran #'.$model->no_surat;
\yii\web\YiiAsset::register($this);
?>
<div class="offer-view">
    <div class="row">
        <div class="col-sm-9">
            <h1>
            <?php if(Yii::$app->user->identity->type == 'Marketing'): ?>
                <?= Html::a('<i class="glyphicon glyphicon-chevron-left"></i>', ['selfcustomer/view', 'id' => $model->perusahaan], ['class' => 'btn btn-success']) ?>
            <?php endif; ?>
                Detail Penawaran <b>#<?= $model->no_surat ?></b>
            </h1>
        </div>
        <div class="col-sm-3">
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
            [
                'attribute'=>'harga',
                'value'=>function($data){
                    $ppn = ($data->harga*11)/100;
                    $pph = round_up(($data->harga*0.3)/100,2);
                    $include = $data->harga+$ppn+$pph;
                    if($data->pajak === 'PPN'){
                        return $data->harga.' ('.'include PPN & PPH22 : '.$include.')';
                    }else{
                        return $data->harga;
                    }
                }
            ],
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
                'attribute'=>'show_tax',
                'format'=>'raw',
                'value'=>function($data){
                    if($data->show_tax === 1){
                        return '<i class="fa fa-fw fa-check"></i>';
                    }else{
                        return ' ';
                    }
                },
            ],
        ],
    ]) ?>   
    </div>

</div>
