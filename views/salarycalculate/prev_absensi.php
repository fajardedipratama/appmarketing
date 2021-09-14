<?php
use app\models\Karyawan;
use app\models\Jobtitle;
use app\models\AttendanceData;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SalaryCalculate */

$karyawan = Karyawan::find()->where(['<=','tanggal_masuk',$model->end_absen])->orderBy('nama')->all();
$employee = Karyawan::find()->where(['<=','tanggal_masuk',$model->end_absen])->orderBy('nama')->all();

$this->title = "Preview";
\yii\web\YiiAsset::register($this);
?>
<div class="salary-calculate-view">

    <h1>
        <?= Html::a('<i class="glyphicon glyphicon-chevron-left"></i>', ['view','id'=>$model->id], ['class' => 'btn btn-success']) ?>
        <?= Html::encode($this->title) ?>
    </h1>
    <h5>Absensi - Periode <?= $model->bulan.'/'.$model->tahun ?></h5>

    <div class="box"><div class="box-body"><div class="table-responsive">
    <table class="table table-bordered">
    <!-- header -->
        <tr>
            <th style="text-align:center">Tanggal</th>

        <?php foreach($karyawan as $show): ?>
        <?php if($show['tgl_resign']==NULL || $show['tgl_resign']>=$model->begin_absen): ?>
            <th><?= $show['nama'] ?></th>
        <?php endif; ?>
        <?php endforeach ?>
        </tr>
    <!-- value -->
        <?php 
            $begin = $model->begin_absen;
            $end = $model->end_absen;
            while (strtotime($begin) <= strtotime($end)) : 
        ?>
        <tr>
            <td><?= date('d/m/Y',strtotime($begin)) ?></td>
            <?php foreach($employee as $show): ?>
            <?php if($show['tgl_resign']==NULL || $show['tgl_resign']>=$model->begin_absen): ?>
                <?php $absen=AttendanceData::find()->where(['karyawan_id'=>$show['id']])->andWhere(['work_date'=>$begin])->one(); ?>
                <td>
                    <?php if($absen): ?>
                        <?= date('H:i',strtotime($absen->real_in)).' - '.date('H:i',strtotime($absen->real_out)) ?>
                    <?php endif; ?>
                </td>
            <?php endif; ?>
            <?php endforeach ?>
        </tr>
        <?php
            $begin = date ("Y-m-d", strtotime("+1 days", strtotime($begin))); 
            endwhile; 
        ?>
    <!-- value -->
    </table>
    </div></div></div>

</div>
