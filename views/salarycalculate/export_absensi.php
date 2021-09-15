<?php
use app\models\Karyawan;
use app\models\Jobtitle;
use app\models\AttendanceData;

$karyawan = Karyawan::find()->where(['<=','tanggal_masuk',$model->end_absen])->orderBy('nama')->all();

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Absensi.xls");

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Export Absensi</title>
</head>
<body>
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
            <?php foreach($karyawan as $show): ?>
            <?php if($show['tgl_resign']==NULL || $show['tgl_resign']>=$model->begin_absen): ?>
                <?php $absen=AttendanceData::find()->where(['karyawan_id'=>$show['id']])->andWhere(['work_date'=>$begin])->one(); ?>
                <td style="background-color:
                 <?php 
                    if(date('l',strtotime($begin)) == 'Sunday'){
                        echo 'grey';
                    } 
                ?>;">
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
</body>
</html>