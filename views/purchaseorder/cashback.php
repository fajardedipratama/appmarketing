<?php 
use app\models\PurchaseOrder;
use app\models\City;

$invoice = $model->harga;
$pokok = $model->harga-$model->cashback;
$cashback = $model->cashback;
$ppn = round($model->cashback*0.1);
$dpp = round($model->harga/1.1);

function pph($invoice,$pokok){
	$dpp = round($invoice/1.1);
	$selisih = abs($dpp-$pokok);
	return round($selisih*0.05);
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
		<td><?= Yii::$app->formatter->asCurrency($invoice) ?></td>
	</tr>
	<tr>
		<td>Harga Pokok</td><td></td>
		<td><?= Yii::$app->formatter->asCurrency($pokok) ?></td>
	</tr>
	<tr style="background-color: lightgrey;">
		<td>Cashback</td><td></td>
		<td><?= Yii::$app->formatter->asCurrency($cashback) ?></td>
	</tr>
	<tr style="background-color: lightgrey;">
		<td>PPN 10%</td><td>10% x Cashback</td>
		<td><?= Yii::$app->formatter->asCurrency($ppn) ?></td>
	</tr>
<?php if($cashback > 500): ?>
	<tr>
		<td>DPP</td><td>Harga Invoice / 1,1</td>
		<td><?= Yii::$app->formatter->asCurrency($dpp) ?></td>
	</tr>
	<tr>
		<td>DPP-Harga Pokok</td>
		<td><?= Yii::$app->formatter->asCurrency($dpp).' - '.Yii::$app->formatter->asCurrency($pokok) ?></td>
		<td><?= Yii::$app->formatter->asCurrency(abs($dpp-$pokok)) ?></td>
	</tr>
	<tr style="background-color: lightgrey;">
		<td>PPh 5%</td><td>5% x <?= Yii::$app->formatter->asCurrency(abs($dpp-$pokok)) ?></td>
		<td><?= Yii::$app->formatter->asCurrency(pph($invoice,$pokok)) ?></td>
	</tr>
<?php endif; ?>
	<tr style="background-color: lightgrey;font-weight: bold;">
		<td>Cashback Diterima</td>
<?php if($model->cashback > 500): ?>
		<td>Volume x (Cashback-PPN-PPh)</td>
		<td><?= Yii::$app->formatter->asCurrency($model->volume*($cashback-$ppn-pph($invoice,$pokok))) ?></td>
<?php else: ?>
		<td>Volume x (Cashback-PPN)</td>
		<td><?= Yii::$app->formatter->asCurrency($model->volume*($cashback-$ppn)) ?></td>
<?php endif; ?>
	</tr>
</table>
</body>
</html>