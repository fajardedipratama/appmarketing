<?php 
use app\models\City;
use app\models\OfferNumber;

$hariIni = \Carbon\Carbon::now()->locale('id');
$lokasi = City::find()->where(['id'=>$model->customer->lokasi])->one();
$inisial = OfferNumber::find()->where(['id'=>1])->one();

?>
<!DOCTYPE html>
<html>
<head>
	<title>(<?= $model->no_surat ?>) Surat Penawaran PT Berdikari Jaya Bersama</title>
	<style type="text/css">
		.back {
		  width: 100%;
		  display: block;
		  position: relative;
		}

		.back::after {
		  content: "";
		  background: url(photos/logo.png);
		  background-size: 90% 35%;
		  background-repeat: no-repeat;
		  background-position: center;
		  opacity: 0.2;
		  top: 0;
		  left: 0;
		  bottom: 0;
		  right: 0;
		  position: absolute;
		  z-index: -1;   
		}
	</style>
</head>
<body style="margin-top: 0">
<div class="back">
<table style="font-family: Calibri">
	<tr>
		<td width="20%"><img src="photos/logo.png" style="width: 105%"></td>
		<td width="80%" style="text-align: center">
			<font style="font-weight: bold;font-size: 28px">PT. BERDIKARI JAYA BERSAMA</font><br>
			<font style="font-size: 18px">ENVIRONMENTAL PROTECTION ENERGY</font><br>
			<font style="font-size: 14px">Jl. Raya Lumajang KM 5 No. 618</font><br>
			<font style="font-size: 14px">Kelurahan Kedung Asem – Kecamatan Wonoasih – Kota Probolinggo – Jawa Timur</font><br>
			<font style="font-size: 14px">Telp/ Fax : 0335 – 421809</font>
		</td>
	</tr>
	<tr><td colspan="2"><hr style="height: 3px;background-color: black"></td></tr>
</table>
<table style="font-family: Arial;font-size: 15px">
	<tr>
		<td width="12%" style="font-weight: bold;">No</td>
		<td>: 0<?= $model->no_surat ?> / <?= $inisial['inisial'] ?> / <?= date('Y') ?></td>
	</tr>
	<tr>
		<td width="12%" style="font-weight: bold;">Tanggal</td>
		<td>: Surabaya, <?= date('d ').$hariIni->monthName.date(' Y'); ?></td>
	</tr>
	<tr>
		<td width="12%" style="font-weight: bold;">Perihal</td>
		<td>: Penawaran Minyak Diesel Industri</td>
	</tr>
	<tr><td colspan="2"><br></td></tr>

	<tr><td colspan="2">Kepada Yth. <?= $model->pic ?></td></tr>
	<tr><td colspan="2"><?= $model->customer->perusahaan ?></td></tr>
	<tr><td colspan="2"><?= ucfirst(strtolower($lokasi['kota'])) ?></td></tr>
	<tr><td colspan="2"><br></td></tr>

	<tr><td colspan="2">Dengan Hormat,</td></tr>
	<tr><td colspan="2" style="text-align: justify;line-height: 1.5em"><span style="display:inline-block; width: 4%;"></span>Melalui surat ini kami jelaskan bahwa PT. Berdikari Jaya Bersama adalah perusahaan yang bergerak dalam penyediaan Bahan Bakar Minyak Diesel Industri. Adapun penawaran harganya yang berlaku sesuai periode <?= $inisial['periode'] ?>, adalah sebagai berikut :</td></tr>
	<tr><td colspan="2"><br></td></tr>

	<tr><td colspan="2" style="font-weight: bold;">HARGA SATUAN / LITER : <?= Yii::$app->formatter->asCurrency($model->harga) ?> / Liter </td></tr>
	<tr><td colspan="2"><br></td></tr>

	<tr>
		<td colspan="2" style="font-size: 14px;font-weight: bold;line-height: 1.5em">
			<font style="font-style: italic;">Note :</font>
			<ul>
				<li>Minimal per PO 5.000 liter</li>
				<li>Toleransi susut yang berlaku adalah 0,5%</li>
				<li>
					<?php if($model->pajak === 'PPN'){
						echo 'Harga termasuk PPN';
					}else{
						echo 'Harga Non PPN';
					}?>
				</li>
				<li>Term Of Payment : <?= $model->top ?></li>
				<li>Pengiriman setelah PO (Purchase Order) </li>
				<li>
					<?php if($model->pajak === 'PPN'){
						echo 'Rekening Bank Mandiri (PPN) :  1430014465569 a.n. PT. Berdikari Jaya Bersama Cabang Probolinggo';
					}else{
						echo 'Rekening Bank BCA (NON PPN) :  0566515151 a.n. Godwin';
					}?>
				</li>
				<li>Hubungi Sales : <?= $model->karyawan->nama_pendek.' ( '.$model->karyawan->no_hp.' )' ?></li>
			</ul>
		</td>
	</tr>
	<tr><td colspan="2"><br></td></tr>

	<tr><td colspan="2" style="text-align: justify;line-height: 1.5em">Demikian surat penawaran ini kami ajukan untuk dapat dipertimbangkan. Atas perhatian dan kerjasamanya kami ucapkan terima kasih.</td></tr>
	<tr><td colspan="2"><br></td></tr>

	<tr><td colspan="2">Hormat Kami,<br>PT. BERDIKARI JAYA BERSAMA</td></tr>
	<tr>
		<td colspan="2"><img src="photos/ttdyuwi.jpg" style="width: 25%"></td>
	</tr>
	<tr><td colspan="2" style="font-weight: bold;line-height: 1.5em"><u>Yuwie Santoso,</u><br>Direktur</td></tr>

</table>
</div>
</body>
</html>