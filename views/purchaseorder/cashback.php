<?php 
use app\models\PurchaseOrder;
use app\models\City;
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Detail Cashback</title>
</head>
<body>
<table style="font-family: Arial;font-size: 15px;margin-left: 5%" cellpadding="3" cellspacing="0" border="1">
	<tr><td colspan="3" style="text-align: center;"><h1>DETAIL CASHBACK</h1></td></tr>
	<tr style="font-weight: bold;">
		<td><?= $model->customer->perusahaan.' - '.$model->city->kota ?></td>
		<td>Kirim <?= $model->tgl_kirim ?></td>
		<td><?= $model->volume ?> Liter</td>
	</tr>
	<tr>
		<td>Harga Invoice</td><td></td>
		<td><?= Yii::$app->formatter->asCurrency($model->harga) ?></td>
	</tr>
	<tr>
		<td>Harga Pokok</td><td></td>
		<td><?= Yii::$app->formatter->asCurrency($model->harga-$model->cashback) ?></td>
	</tr>
	<tr>
		<td>Cashback</td><td></td>
		<td><?= Yii::$app->formatter->asCurrency($model->cashback) ?></td>
	</tr>
	<tr>
		<td>PPN 10%</td><td>10% x Cashback</td>
		<td><?= Yii::$app->formatter->asCurrency($model->cashback*0.1) ?></td>
	</tr>
	<tr>
		<td>DPP</td><td>Harga Invoice / 1,1</td>
		<td><?= Yii::$app->formatter->asCurrency($model->harga/1.1) ?></td>
	</tr>
	<tr>
		<td>DPP-Harga Pokok</td>
		<td><?= Yii::$app->formatter->asCurrency($model->harga/1.1).' - '.Yii::$app->formatter->asCurrency($model->harga-$model->cashback) ?></td>
		<td><?= Yii::$app->formatter->asCurrency(($model->harga/1.1)-($model->harga-$model->cashback)) ?></td>
	</tr>
	<tr>
		<td>PPh 5%</td><td>5% x <?= Yii::$app->formatter->asCurrency(($model->harga/1.1)-($model->harga-$model->cashback)) ?></td>
		<td><?= Yii::$app->formatter->asCurrency((($model->harga/1.1)-($model->harga-$model->cashback))*0.05) ?></td>
	</tr>
	<tr>
		<td>Cashback Diterima</td><td>Cashback-PPN-PPh</td>
		<td><?= Yii::$app->formatter->asCurrency($model->volume*($model->cashback-($model->cashback*0.1)-((($model->harga/1.1)-($model->harga-$model->cashback))*0.05))) ?></td>
	</tr>
</table>
</body>
</html>