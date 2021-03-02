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
          <?php if(strtotime($model->expired) >= strtotime(date('Y-m-d'))): ?>
            <h5><?= $model->city->kota ?> - Exp.<?= date('d/m/Y',strtotime($model->expired))?></h5>
          <?php else: ?>
            <h5><?= $model->city->kota ?> - Exp. - </h5>
          <?php endif; ?>
        </div>
        <div class="col-sm-5">
            <p>
                <?= Html::a('<i class="fa fa-fw fa-pencil"></i> Ubah', ['update', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
              <?php if($model->verified !== 'no'): ?>
                <button class="btn btn-primary" data-toggle="modal" data-target="#daily-report"><i class="fa fa-fw fa-plus-square"></i> Progress</button>
                <?= Html::a('<i class="fa fa-fw fa-plus-square"></i> Penawaran', ['offer/create', 'id' => $model->id], ['class' => 'btn btn-danger']) ?>
              <?php else: ?>
                <button class="btn btn-primary disabled"><i class="fa fa-fw fa-plus-square"></i> Progress</button>
                <button class="btn btn-danger disabled"><i class="fa fa-fw fa-plus-square"></i> Penawaran</button>
              <?php endif; ?>
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
                        ]
                    ],
                ]) ?>
                </div>
            </div>
            <div class="active tab-pane" id="progress">
              <small style="color: red">*Perubahan data progress harap lapor ke IT</small>
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
              <small style="color: red">*Perubahan data penawaran harap lapor ke IT</small>
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

    <div class="modal fade" id="daily-report"><div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>Progress Perusahaan</b></h4>          
            </div>
            <div class="modal-body">
              <?= $this->render('_formprogress', ['model' => $model,'modelprogress' => $modelprogress]) ?>
            </div>
        </div>
    </div></div>

</div>
