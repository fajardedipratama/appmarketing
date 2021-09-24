<?php 
use app\models\Karyawan;
use app\models\Jobtitle;
use app\models\PermitAccess;

$jabatan = Jobtitle::find()->where(['id'=>$model->karyawan->posisi])->one();
$personalia = PermitAccess::find()->where(['tipe_akses'=>'Personalia'])->one();
$kacab = PermitAccess::find()->where(['tipe_akses'=>'Ka.Cabang Sby'])->one();

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Print Form Cuti & Izin</title>
</head>
<body style="margin-top: 0">
<table style="font-family: Arial;font-size: 12px;" border="1" cellspacing="0" cellpadding="7">
	<tr>
		<td colspan="2" align="center" style="padding:0"><h3>SURAT KETERANGAN IZIN<br>PT. BERDIKARI JAYA BERSAMA</h3></td>
	</tr>
	<tr>
		<td width="50%">Karyawan : <?= $model->karyawan->nama_pendek.' ('.$jabatan['posisi'].')'; ?></td>
		<td width="50%">Tanggal : 
			<?php 
			if($model->tgl_mulai==$model->tgl_selesai){
				echo date('d/m/Y',strtotime($model->tgl_mulai));
			}else{
				echo date('d/m/Y',strtotime($model->tgl_mulai)).' - '.date('d/m/Y',strtotime($model->tgl_selesai));
			}
			?>
		</td>
	</tr>
	<tr>
		<td>Jam Masuk : <?= $model->jam_masuk ?></td>
		<td>Jam Keluar : <?= $model->jam_keluar ?></td>
	</tr>
	<tr>
		<td colspan="2">Keterangan : <?= $model->kategori.' ('.$model->alasan.')' ?></td>
	</tr>
	<tr>
		<td colspan="2">
			<table>
			<tr align="center">
				<td style="padding: 0px 25px 0px 25px">Ka.Cabang Sby,<br><br><br><br><?= $kacab->karyawan->nama ?></td>
				<td style="padding: 0px 25px 0px 25px">Personalia,<br><br><br><br><br><?= $personalia->karyawan->nama ?></td>
				<td style="padding: 0px 25px 0px 25px">Pemohon,<br><br><br><br><br><?= $model->karyawan->nama_pendek ?></td>
			</tr>
			</table>
		</td>
	</tr>
</table>

</body>
</html>