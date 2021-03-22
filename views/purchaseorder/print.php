<?php 
use app\models\PurchaseOrder;

?>
<!DOCTYPE html>
<html>
<head>
	<title>Form PO <?= $model->customer->perusahaan ?></title>
</head>
<body style="margin-top: 0">

<table style="font-family: Arial;font-size: 15px;margin-left: 10%" cellpadding="7">
	<thead>
		<tr>
			<td colspan="2" style="font-size: 18px;font-weight: bold;">FORMULIR PURCHASE ORDER (PO)</td>
		</tr>
	</thead>
	<tbody>
		<tr><td><br></td></tr>
		<tr>
			<td style="font-weight: bold;">Nama Sales</td><td>: <?= $model->karyawan->nama ?></td>
		</tr>
		<tr>
			<td style="font-weight: bold;">No. PO</td><td>: <?= $model->no_po ?></td>
		</tr>
		<tr>
			<td style="font-weight: bold;">Tanggal PO</td><td>: <?= date('d/m/Y',strtotime($model->tgl_po))  ?></td>
		</tr>
		<tr>
			<td style="font-weight: bold;">Tanggal Kirim</td><td>: <?= date('d/m/Y',strtotime($model->tgl_kirim))  ?></td>
		</tr>
		<tr>
			<td style="font-weight: bold;">Perusahaan</td><td>: <?= $model->customer->perusahaan ?></td>
		</tr>
		<tr>
			<td style="font-weight: bold;">Alamat Perusahaan</td><td>: <?= $model->alamat ?></td>
		</tr>
		<tr>
			<td style="font-weight: bold;">Alamat Kirim</td><td>: <?= $model->alamat_kirim ?></td>
		</tr>
		<tr>
			<td style="font-weight: bold;">Purchasing</td><td>: <?= $model->purchasing.'-'.$model->no_purchasing ?></td>
		</tr>
		<tr>
			<td style="font-weight: bold;">Keuangan</td><td>: <?= $model->keuangan.'-'.$model->no_keuangan ?></td>
		</tr>
		<tr>
			<td style="font-weight: bold;">Penerima Barang</td><td>: <?= $model->penerima ?></td>
		</tr>
		<tr>
			<td style="font-weight: bold;">Volume (l)</td><td>: <?= $model->volume ?></td>
		</tr>
		<tr>
			<td style="font-weight: bold;">Harga/liter</td><td>: <?= $model->harga.' ('.$model->pajak.')' ?></td>
		</tr>
		<tr>
			<td style="font-weight: bold;">Cashback</td><td>: <?= $model->cashback ?></td>
		</tr>
		<tr>
			<td style="font-weight: bold;">Pembayaran</td><td>: <?= $model->termin ?></td>
		</tr>
		<tr>
			<td style="font-weight: bold;">Metode Bayar</td><td>: <?= $model->pembayaran ?></td>
		</tr>
		<tr>
			<td style="font-weight: bold;">Catatan</td><td>: <?= $model->catatan ?></td>
		</tr>
	</tbody>
</table>

</body>
</html>