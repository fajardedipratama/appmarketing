<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Dailyreport;
use app\models\Karyawan;
/* @var $this yii\web\View */
/* @var $model app\models\Customer */

$this->title = $model->perusahaan;

$query = Dailyreport::find()->where(['perusahaan'=>$model->id])->orderBy(['waktu'=>SORT_DESC])->all();

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
                <button class="btn btn-primary" data-toggle="modal" data-target="#daily-report"><i class="fa fa-fw fa-signal"></i> Progress</button>
            </p>
        </div>
    </div>

    <section class="content">
      <div class="nav-tabs-custom tab-success">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#info" data-toggle="tab">Info</a></li>
          <li><a href="#progress" data-toggle="tab">Progress</a></li>
        </ul>

        <div class="tab-content">
            <div class="active tab-pane" id="info">
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
            <div class="tab-pane" id="progress">
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
                </tr>
            <?php foreach($query as $daily): ?>
            <?php $sales=Karyawan::find()->where(['id'=>$daily['sales']])->one(); ?>
                <tr>
                  <td><?= $daily['waktu']; ?></td>
                  <td><?= $sales['nama']; ?></td>
                  <td><?= $daily['keterangan']; ?></td>
                  <td><?= $daily['volume']; ?></td>
                  <td><?= $daily['jarak_ambil']; ?></td>
                  <td><?= $daily['catatan']; ?></td>
                  <td><?= $daily['pengingat']; ?></td>
                </tr>
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
