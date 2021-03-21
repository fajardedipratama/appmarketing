<?php
use app\models\Offer;
use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Karyawan;
/* @var $this yii\web\View */
/* @var $model app\models\Karyawan */

$this->title = 'Statistik Harian ('.date('d/m/Y',strtotime($_GET['time'])).')';
\yii\web\YiiAsset::register($this);

$query = Karyawan::find()->where(['posisi'=>6,'status_aktif'=>'Aktif'])->orderBy(['nama_pendek'=>SORT_ASC])->all();

?>
<div class="karyawan-view">

    <div class="row">
        <div class="col-sm-10">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-sm-2">
            <?= Html::a('<i class="fa fa-fw fa-calendar"></i> Statistik Total', ['index'], ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <br>
    <div class="box"><div class="box-body"><div class="table-responsive">
    <table class="table table-bordered">
        <tr>
            <th>Nama</th>
            <th>Penawaran Baru</th>
            <th>Penawaran Follow Up</th>
            <th>Penawaran Gagal</th>
            <th>Total Terkirim</th>
        </tr>
    <?php foreach($query as $print): ?>
    <?php 
    	$new = Offer::find()->where(['tanggal'=>$_GET['time'],'status'=>'Terkirim'])->andWhere(['like','is_new','yes'])->andWhere(['sales'=>$print['id']])->count(); 
    	$fup = Offer::find()->where(['tanggal'=>$_GET['time'],'status'=>'Terkirim'])->andWhere(['like','is_new','no'])->andWhere(['sales'=>$print['id']])->count();
    	$fail = Offer::find()->where(['tanggal'=>$_GET['time'],'status'=>'Gagal Kirim'])->andWhere(['sales'=>$print['id']])->count(); 
    ?>
        <tr>
            <td><?= $print['nama_pendek']; ?></td>
            <td><?= $new; ?></td>
            <td><?= $fup ?></td>
            <td><?= $fail ?></td>
            <td><?= $new+$fup ?></td>
        </tr>
    <?php endforeach ?>
    </table>
    </div></div></div>
</div>