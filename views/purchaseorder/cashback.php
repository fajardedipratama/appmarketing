<?php 
use app\models\PurchaseOrder;
use app\models\City;

function selisih($invoice,$pokok){
	$dpp = $invoice/1.1;
	$selisih = $dpp-$pokok;
	return $selisih;
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Detail Cashback</title>
</head>
<body>
<table style="font-family: Arial;font-size: 15px;margin-left: 5%" cellpadding="3" cellspacing="0" border="1">
	<tr>
		<td colspan="3" style="text-align: center;background-color: green;color: white;">
			<h1>DETAIL CASHBACK</h1>
			<h5><?= $model->customer->perusahaan ?></h5>
		</td>
	</tr>
	<tr style="font-weight: bold;background-color: yellow;">
		<td colspan="3">Kirim <?= $model->city->kota.', '.date('d/m/Y',strtotime($model->tgl_kirim)) ?> Volume <?= $model->volume ?> Liter</td>
	</tr>
	<tr>
		<td>Harga Invoice</td><td></td>
		<td><?= Yii::$app->formatter->asCurrency($model->harga) ?></td>
	</tr>
	<tr>
		<td>Harga Pokok</td><td></td>
		<td><?= Yii::$app->formatter->asCurrency($model->harga-$model->cashback) ?></td>
	</tr>
	<tr style="background-color: lightgrey;">
		<td>Cashback</td><td></td>
		<td><?= Yii::$app->formatter->asCurrency($model->cashback) ?></td>
	</tr>
	<tr style="background-color: lightgrey;">
		<td>PPN 10%</td><td>10% x Cashback</td>
		<td><?= Yii::$app->formatter->asCurrency($model->cashback*0.1) ?></td>
	</tr>
<?php if(selisih($model->harga,$model->harga-$model->cashback) >= 0): ?>
	<tr>
		<td>DPP</td><td>Harga Invoice / 1,1</td>
		<td><?= Yii::$app->formatter->asCurrency(round($model->harga/1.1)) ?></td>
	</tr>
	<tr>
		<td>DPP-Harga Pokok</td>
		<td><?= Yii::$app->formatter->asCurrency(round($model->harga/1.1)).' - '.Yii::$app->formatter->asCurrency($model->harga-$model->cashback) ?></td>
		<td><?= Yii::$app->formatter->asCurrency(round($model->harga/1.1)-($model->harga-$model->cashback)) ?></td>
	</tr>
	<tr style="background-color: lightgrey;">
		<td>PPh 5%</td><td>5% x <?= Yii::$app->formatter->asCurrency(round($model->harga/1.1)-($model->harga-$model->cashback)) ?></td>
		<td><?= Yii::$app->formatter->asCurrency(round((round($model->harga/1.1)-($model->harga-$model->cashback))*0.05)) ?></td>
	</tr>
<?php endif; ?>
	<tr style="background-color: lightgrey;font-weight: bold;">
		<td>Cashback Diterima</td>
<?php if(selisih($model->harga,$model->harga-$model->cashback) >= 0): ?>
		<td>Volume x (Cashback-PPN-PPh)</td>
		<td><?= Yii::$app->formatter->asCurrency($model->volume*($model->cashback-($model->cashback*0.1)-round((($model->harga/1.1)-($model->harga-$model->cashback))*0.05))) ?></td>
<?php else: ?>
		<td>Volume x (Cashback-PPN)</td>
		<td><?= Yii::$app->formatter->asCurrency($model->volume*($model->cashback-($model->cashback*0.1))) ?></td>
<?php endif; ?>
	</tr>
</table>
</body>
</html>