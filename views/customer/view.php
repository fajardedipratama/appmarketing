<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Dailyreport;
use app\models\Offer;
use app\models\Karyawan;
/* @var $this yii\web\View */
/* @var $model app\models\Customer */

$this->title = $model->perusahaan;

$progress = Dailyreport::find()->where(['perusahaan'=>$model->id])->orderBy(['waktu'=>SORT_DESC])->all();
$offers = Offer::find()->where(['perusahaan'=>$model->id])->orderBy(['waktu'=>SORT_DESC])->all();

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
                <?= Html::a('<i class="fa fa-fw fa-pencil"></i> Ubah', ['update', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
                <?= Html::a('<i class="fa fa-fw fa-trash"></i> Hapus', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Hapus data ini ?',
                        'method' => 'post',
                    ],
                ]) ?>
                <?= Html::a('<i class="fa fa-fw fa-refresh"></i> Gabung', ['merge', 'id' => $model->id], ['class' => 'btn btn-primary','target'=>'_blank']) ?>
            </p>
        </div>
    </div>
    
    <section class="content">
    <div class="nav-tabs-custom tab-success">
      <ul class="nav nav-tabs">
        <li><a href="#info" data-toggle="tab">Info</a></li>
        <li class="active"><a href="#progress" data-toggle="tab">Progress</a></li>
        <li><a href="#offers" data-toggle="tab">Penawaran</a></li>
      </ul>

<div class="tab-content">
    <div class="tab-pane" id="info">
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
                [
                  'attribute'=>'sales',
                  'value'=>($model->karyawan)?$model->karyawan->nama:'-',
                ],
                [
                  'attribute'=>'created_by',
                  'value'=>($model->karyawan)?$model->createdby->nama:'-',
                ],
                [
                    'attribute'=>'created_time',
                    'value'=>date('d-M-Y H:i',strtotime($model->created_time)),
                ]
            ],
        ]) ?>
        </div>
    </div>
    <div class="active tab-pane" id="progress">
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
            <tr>
                <th>Waktu</th>
                <th>Sales</th>
                <th>Keterangan</th>
                <th>Volume(KL)</th>
                <th>Jarak Ambil</th>
                <th>Catatan</th>
                <th>Hub.Balik</th>
                <th>By</th>
            </tr>
        <?php foreach($progress as $daily): ?>
        <?php $sales=Karyawan::find()->where(['id'=>$daily['sales']])->one(); ?>
            <tr>
                <td><?= date("d/m/Y",strtotime($daily['waktu'])); ?></td>
                <td><?= $sales['nama_pendek']; ?></td>
                <td><?= $daily['keterangan']; ?></td>
                <td><?= $daily['volume']; ?></td>
                <td><?= $daily['jarak_ambil']; ?></td>
                <td><?= $daily['catatan']; ?></td>
                <td>
                    <?php if($daily['pengingat']!=NULL): ?>
                      <?= date("d/m/Y",strtotime($daily['pengingat'])); ?>
                    <?php endif; ?>
                </td>
                <td>
                    <?php if($daily['con_used']==='Telfon Kantor'): ?>
                      <i class="fa fa-fw fa-phone"></i>
                    <?php elseif($daily['con_used']==='WA Pribadi'): ?>
                      <i class="fa fa-fw fa-whatsapp"></i> 
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach ?>
            </table>
            </div>
    </div>
    <div class="tab-pane" id="offers">
        <div class="box-body table-responsive no-padding">
        <table class="table table-hover">
            <tr>
                <th>Waktu</th>
                <th>No.Surat</th>
                <th>PIC</th>
                <th>TOP</th>
                <th>Harga</th>
                <th>Sales</th>
                <th>Catatan</th>
            </tr>
        <?php foreach($offers as $tawar): ?>
        <?php $sales=Karyawan::find()->where(['id'=>$tawar['sales']])->one(); ?>
            <tr>
                <td><?= date("d/m/Y",strtotime($tawar['tanggal'])); ?></td>
                <td><?= $tawar['no_surat']; ?></td>
                <td><?= $tawar['pic']; ?></td>
                <td><?= $tawar['top']; ?></td>
                <td><?= $tawar['harga']; ?></td>
                <td><?= $sales['nama_pendek']; ?></td>
                <td>
                <a href="#" data-toggle="modal" data-target="#offer<?= $tawar['id'] ?>"><i class="fa fa-fw fa-eye"></i></a>
                </td>
            </tr>

      <div class="modal fade" id="offer<?= $tawar['id'] ?>"><div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>No.Surat : <?= $tawar['no_surat'] ?></b></h4>          
            </div>
            <div class="modal-body">
              <ul>
                <li><b>Pajak :</b> <?= $tawar['pajak'] ?></li>
                <li><b>Catatan :</b> <?= $tawar['catatan'] ?></li>
              </ul>
            </div>
        </div>
      </div></div>

        <?php endforeach ?>
        </table>
        </div>
    </div>
</div>

    </div>
    </section>

</div>
