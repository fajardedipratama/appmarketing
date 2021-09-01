<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use app\models\AttendanceSchedule;
use app\models\AttendanceData;
use app\models\Karyawan;
/* @var $this yii\web\View */
/* @var $model app\models\AttendanceData */

$karyawan = Karyawan::find()->where(['status_aktif'=>'Aktif'])->all();
$jadwal = AttendanceSchedule::find()->where(['hari'=>date('l',strtotime($_GET['work_date']))])->one();

$this->title ='Absensi Harian';
\yii\web\YiiAsset::register($this);
?>
<div class="attendance-data-view">

    <div class="row">
        <div class="col-sm-9">
            <h1><?= Html::encode($this->title) ?></h1>
            <h5 style="font-style: italic;">Tanggal <?= date('d/m/Y',strtotime($_GET['work_date'])) ?></h5>
        </div>
        <div class="col-sm-3">
        <?php if(Yii::$app->user->identity->type == 'Administrator'): ?>
            <button class="btn btn-primary" data-toggle="modal" data-target="#searchglobal"><i class="fa fa-fw fa-search"></i> Cari</button>
            <?= Html::a('<i class="fa fa-fw fa-calendar"></i> Jadwal Kerja', ['attendanceschedule/index'], ['class' => 'btn btn-success']) ?>
        <?php endif; ?>
        </div>
    </div>

    <div class="box table-responsive">
    <table class="table table-bordered table-hover table-striped">
        <tr>
            <th width="25%">Karyawan</th>
            <th width="25%">Jadwal</th>
            <th width="25%">Absensi</th>
            <th width="20%">Aksi</th>
        </tr>
    <?php foreach($karyawan as $show): ?>
    <?php 
        $data=AttendanceData::find()->where(['karyawan_id'=>$show->id,'work_date'=>$_GET['work_date']])->one(); 
    ?>
        <tr>
            <td><?= $show->nama_pendek ?></td>
            <td><?= $jadwal->jam_masuk.' - '.$jadwal->jam_pulang ?></td>
            <td>
                <?php if(!empty($data->real_in)){
                    echo $data->real_in.' - '.$data->real_out;
                } ?>        
            </td>
            <td>
            <?php 
                if(empty($data->real_in)){
                    echo '<button class="btn btn-xs btn-success" data-toggle="modal" data-target="#checkabsen'.$show->id.'"><i class="fa fa-fw fa-check-square-o"></i> Input</button>';
                }else{
                    echo Html::a('<i class="fa fa-fw fa-pencil"></i>',["update",'id'=>$model->id]);
                }
            ?> 
            </td>
        </tr>

<!-- modal input-->
    <div class="modal fade" id="checkabsen<?= $show->id ?>">
    <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><b>Input Absensi : <?= $show->nama_pendek ?></b></h4>          
        </div>
        <div class="modal-body">
        <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($model, 'karyawan_id')->hiddenInput(['value'=>$show->id])->label(false) ?>
            <div class="row">
                <div class="col-sm-6">
                    <?= $form->field($model, 'real_in')->textInput(['type'=>'time','value'=>'08:00']) ?>
                </div>
                <div class="col-sm-6">
                    <?= $form->field($model, 'real_out')->textInput(['type'=>'time','value'=>'17:00']) ?>
                </div>
            </div>
            <div class="form-group">
                <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
            </div>
        <?php ActiveForm::end(); ?>
        </div>
    </div>
    </div>
    </div>
<!-- modal input-->

    <?php endforeach ?>
    </table>
    </div>

<!-- modal search-->
    <div class="modal fade" id="searchglobal">
    <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><b>Pencarian Tanggal</b></h4>          
        </div>
        <div class="modal-body">
            <?= $this->render('_search', ['model' => $model]) ?>
        </div>
    </div>
    </div>
    </div>
<!-- modal search-->

</div>
