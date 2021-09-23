<?php
use app\models\PermitAccess;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Permit */

$personalia = PermitAccess::find()->where(['tipe_akses'=>'Personalia'])->one();
$kacab = PermitAccess::find()->where(['tipe_akses'=>'Ka.Cabang Sby'])->one();

$this->title = 'Detail Cuti & Izin';
\yii\web\YiiAsset::register($this);
?>
<div class="permit-view">

    <div class="row">
        <div class="col-sm-8">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-sm-4">
        <?php if($model->status=='Pending' && Yii::$app->user->identity->profilname==$personalia->karyawan_id): ?>
            <?= Html::a('<i class="fa fa-fw fa-check-square-o"></i> Konfirmasi', ['confirmhrd', 'id' => $model->id], ['class' => 'btn btn-success','data' => ['confirm' => 'Konfirmasi Cuti & Izin ?','method' => 'post']]) ?>
            <?= Html::a('<i class="fa fa-fw fa-pencil"></i> Ubah', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('<i class="fa fa-fw fa-trash"></i> Hapus', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        <?php elseif($model->status=='Konfirmasi-HRD' && Yii::$app->user->identity->profilname==$kacab->karyawan_id): ?>
            <?= Html::a('<i class="fa fa-fw fa-check-square-o"></i> Konfirmasi', ['confirmkacab', 'id' => $model->id], ['class' => 'btn btn-success','data' => ['confirm' => 'Konfirmasi Cuti & Izin ?','method' => 'post']]) ?>
        <?php endif; ?>
        </div>
    </div>

<div class="box"><div class="box-body"><div class="table-responsive">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute'=>'karyawan_id',
                'value'=>($model->karyawan)?$model->karyawan->nama:'-',
            ],
            'kategori',
            'alasan',
            [
                'attribute'=>'tgl_mulai',
                'value'=>function($data){
                    if($data->tgl_mulai==$data->tgl_selesai){
                        return date('d/m/Y',strtotime($data->tgl_mulai));
                    }else{
                        return date('d/m/Y',strtotime($data->tgl_mulai)).' - '.date('d/m/Y',strtotime($data->tgl_selesai));
                    }
                }
            ],
            'jam_masuk',
            'jam_keluar',
            'status',
            'created_time',
        ],
    ]) ?>
</div></div></div>

</div>
