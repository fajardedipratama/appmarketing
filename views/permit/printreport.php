<?php 
use app\models\Permit;
use app\models\Karyawan;
use app\models\Jobtitle;
use app\models\PermitAccess;

$hariIni = \Carbon\Carbon::now()->locale('id');

$personalia = PermitAccess::find()->where(['tipe_akses'=>'Personalia'])->one();
$kacab = PermitAccess::find()->where(['tipe_akses'=>'Ka.Cabang Sby'])->one();

$data = explode("x", $_GET['range']);
$set_awal = $data[0];
$set_akhir = $data[1];

$result = Permit::find()->where(['between','tgl_mulai',$set_awal,$set_akhir])->andWhere(['status'=>'Terverifikasi'])->orderBy(['tgl_mulai'=>SORT_ASC])->all();

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Print Laporan Cuti & Izin</title>
</head>
<body>

<h2>LAPORAN IZIN KARYAWAN</h2>
<font>Periode <?= date('d/m/Y',strtotime($set_awal)).'-'.date('d/m/Y',strtotime($set_akhir)) ?></font>
<table border="1" cellspacing="0" cellpadding="5">
	<thead>
		<th>Tanggal Izin</th>
		<th>Karyawan</th>
		<th>Jabatan</th>
		<th>Izin</th>
		<th>Jam Masuk</th>
		<th>Jam Keluar</th>
		<th>Keterangan</th>
	</thead>
	<tbody>
	<?php foreach ($result as $show) :?>
	<?php $jabatan = Jobtitle::find()->where(['id'=>$show->karyawan->posisi])->one(); ?>
		<tr>
			<td>
				<?php 
				if($show->tgl_mulai==$show->tgl_selesai){
					echo date('d/m/Y',strtotime($show->tgl_mulai));
				}else{
					echo date('d/m/Y',strtotime($show->tgl_mulai)).'-'.date('d/m/Y',strtotime($show->tgl_selesai));
				}
				?>
			</td>
			<td><?= $show->karyawan->nama_pendek ?></td>
			<td><?= $jabatan->posisi ?></td>
			<td><?= $show->kategori ?></td>
			<td><?= $show->jam_masuk ?></td>
			<td><?= $show->jam_keluar ?></td>
			<td><?= $show->alasan ?></td>
		</tr>
	<?php endforeach ?>
	</tbody>
</table><br><br>
<table>
	<tr><td colspan="2">Surabaya, <?= date('d ').$hariIni->monthName.date(' Y'); ?></td></tr>
	<tr>
		<td style="padding-right: 70px;">Ka.Cabang Sby,<br><br><br><br><?= $kacab->karyawan->nama ?></td>
		<td>Personalia,<br><br><br><br><?= $personalia->karyawan->nama ?></td>
	</tr>
</table>

</body>
</html>