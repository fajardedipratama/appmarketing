<?php
use app\models\KasDetail;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Kas */

$detail = KasDetail::find()->where(['kas_id'=>$model->id])->all();

$this->title = 'Kas '.$model->bulan.'/'.$model->tahun;
\yii\web\YiiAsset::register($this);
?>
<div class="kas-view">

<div class="row">
    <div class="col-sm-10">
        <h1><?= Html::encode($this->title) ?></h1>
        <button class="btn btn-success"><i class="fa fa-fw fa-money"></i> Saldo : <?= Yii::$app->formatter->asCurrency($model->saldo); ?></button>
    </div>
    <div class="col-sm-2">
        <button class="btn btn-success" data-toggle="modal" data-target="#input-detail"><i class="fa fa-fw fa-plus-square"></i> Tambah Data</button>
    </div>
</div>
    

<div class="box box-success" style="margin-top:1%"><div class="box-body"><div class="table-responsive">
    <table class="table table-hover table-bordered">
        <tr>
            <th width="10%">Tanggal</th>
            <th width="45%">Kebutuhan</th>
            <th width="15%">Masuk</th>
            <th width="15%">Keluar</th>
            <th width="15%">Saldo</th>
        </tr>
    <?php foreach($detail as $show): ?>
        <tr>
            <td><?= date('d/m/Y',strtotime($show->tgl_kas)); ?></td>
            <td><?= $show->deskripsi; ?></td>
            <td>
                <?php if($show->jenis === 'Masuk'){
                        echo Yii::$app->formatter->asCurrency($show->nominal);
                } ?>  
            </td>
            <td>
                <?php if($show->jenis === 'Keluar'){
                        echo Yii::$app->formatter->asCurrency($show->nominal);
                } ?>  
            </td>
            <td><?= Yii::$app->formatter->asCurrency($show->saldo_akhir) ?></td>
        </tr>
    <?php endforeach ?>
    </table>
    <?= Html::a('<i class="fa fa-fw fa-trash"></i> Hapus Baris Terakhir', ['/kasdetail/deletelast','id' =>$model->id], [
        'class' => 'btn btn-sm btn-danger',
        'data' => [
            'confirm' => 'Hapus Baris Terakhir ?',
            'method' => 'post',
        ],
    ]) ?>
</div></div></div>

    <div class="modal fade" id="input-detail"><div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>Tambah Data</b></h4>          
            </div>
            <div class="modal-body">
              <?= $this->render('_formdetail', ['newModel' => $newModel]) ?>
            </div>
        </div>
    </div></div>

</div>
