<?php 
use app\models\PurchaseOrder;
use app\models\City;

function termin_value($value){
    if($value=='Cash On Delivery'){
        return 0;
    }elseif($value=='Cash Before Delivery'){
        return 0;
    }elseif($value=='Tempo 7 Hari'){
        return 100;
    }elseif($value=='Tempo 14 Hari'){
        return 200;
    }elseif($value=='Tempo 21 Hari'){
        return 300;
    }elseif($value=='Tempo 30 Hari'){
        return 400;
    }
}
function cashback_value($value){
    if($value){
        return ' + Cashback '.$value;
    }
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Form PO <?= $model->customer->perusahaan ?></title>
</head>
<body style="margin-top: 0">

<table border="1" style="font-family: Arial;font-size: 15px;margin-left: 5%" cellpadding="7" cellspacing="0">
	<tbody>
		<tr><td colspan="2" style="font-weight: bold;text-align: center;">FORM PO</td></tr>
		<tr>
			<td style="font-weight: bold;">Perusahaan</td><td><?= $model->customer->perusahaan ?></td>
		</tr>
		<tr>
			<td style="font-weight: bold;">Nama Sales</td><td><?= $model->karyawan->nama ?></td>
		</tr>
		<tr>
			<td style="font-weight: bold;">No. PO</td><td><?= $model->no_po ?></td>
		</tr>
		<tr>
			<td style="font-weight: bold;">Tanggal PO</td><td><?= date('d/m/Y',strtotime($model->tgl_po))  ?></td>
		</tr>
		<tr>
			<td style="font-weight: bold;">Tanggal Kirim</td><td><?= date('d/m/Y',strtotime($model->tgl_kirim))  ?></td>
		</tr>
		<tr>
			<td style="font-weight: bold;">Alamat Perusahaan</td><td><?= $model->alamat ?></td>
		</tr>
		<tr>
			<td style="font-weight: bold;">Alamat Kirim</td><td><?= $model->alamat_kirim ?></td>
		</tr>
		<tr>
			<td style="font-weight: bold;">Volume</td><td><?= $model->volume ?> Liter</td>
		</tr>
		<tr>
			<td style="font-weight: bold;">Pembayaran</td><td><?= $model->termin ?></td>
		</tr>
		<tr>
			<td style="font-weight: bold;">Harga/liter</td>
			<td> 
				<?php 
					$city = City::find()->where(['id'=>$model->kota_kirim])->one();
                    echo ($model->harga-termin_value($model->termin)-$city['oat']-$model->cashback).' + Termin '.termin_value($model->termin).' + OAT '.$city['oat'].cashback_value($model->cashback).' = '.$model->harga;
				?>
			</td>
		</tr>
		<tr>
			<td style="font-weight: bold;">Pajak</td><td><?= $model->pajak ?></td>
		</tr>
		<tr>
			<td style="font-weight: bold;">Metode Bayar</td>
			<td>
				<?php 
					if($model->bilyet_giro == 1){
						echo $model->pembayaran.' (& Backup BG)';
					}else{
						echo $model->pembayaran;
					} 
				?>	
			</td>
		</tr>
		<tr>
			<td style="font-weight: bold;">Purchasing</td><td><?= $model->purchasing.'-'.$model->no_purchasing ?></td>
		</tr>
		<tr>
			<td style="font-weight: bold;">Keuangan</td><td><?= $model->keuangan.'-'.$model->no_keuangan ?></td>
		</tr>
		<tr>
			<td style="font-weight: bold;">Penerima Barang</td><td><?= $model->penerima ?></td>
		</tr>
		<tr>
			<td style="font-weight: bold;">Catatan</td><td><?= $model->catatan ?></td>
		</tr>
		<tr>
			<td style="font-weight: bold;">Status Order</td>
			<td>
				<?php 
					$check=PurchaseOrder::find()->where(['perusahaan'=>$model->perusahaan])->andWhere(['status'=>['Pending','Terkirim','Terbayar-Selesai']])->andWhere(['<=','tgl_po',$model->tgl_po])->count();
                    if($check > 1){
                        echo "Repeat Order";
                    }else{
                        echo "First Order";
                    }
				?>
			</td>
		</tr>
	</tbody>
</table>

</body>
</html>