<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Customer;
use app\models\Offer;
use app\models\PurchaseOrder;
use dosamigos\chartjs\ChartJs;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$all_customer = Customer::find()->count();
$active_customer = Customer::find()->where(['>=','expired',date('Y-m-d')])->count();
$offer = Offer::find()->where(['status'=>'Terkirim'])->count();
$all_po = PurchaseOrder::find()->where(['status'=>['Terkirim','Terbayar-Selesai']])->sum('volume');

$this->title = 'Dashboard';
?>
<div class="dashboard-index">

    <h2><?= Html::encode($this->title) ?></h2>

<section class="content">
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-institution"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Total Perusahaan</span><span class="info-box-number"><?= $all_customer ?></span>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-check-square-o"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Perusahaan Aktif</span>
              <span class="info-box-number"><?= $active_customer ?></span>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-paste"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Penawaran Terkirim</span>
              <span class="info-box-number"><?= $offer ?></span>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-truck"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Purchase Order</span>
              <span class="info-box-number"><?= Yii::$app->formatter->asDecimal(($all_po/1000),0) ?> KL</span>
            </div>
          </div>
        </div>
      </div>

<div class="row">
  <div class="col-sm-9">
  <div class="box"><div class="box-body">
    <?php 
      $jan = PurchaseOrder::find()->where(['between','tgl_kirim','2020-12-28','2021-01-27'])->andWhere(['status'=>['Terkirim','Terbayar-Selesai']])->sum('volume');
      $feb = PurchaseOrder::find()->where(['between','tgl_kirim','2021-01-28','2021-02-27'])->andWhere(['status'=>['Terkirim','Terbayar-Selesai']])->sum('volume');
      $mar = PurchaseOrder::find()->where(['between','tgl_kirim','2021-02-28','2021-03-27'])->andWhere(['status'=>['Terkirim','Terbayar-Selesai']])->sum('volume');
    ?>
    <?= ChartJs::widget([
        'type' => 'line',
        'options' => [
            'height' => 130,
            'width' => 400
        ],
        'data' => [
            'labels' => ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sept","Oct","Nov","Dec"],
            'datasets' => [
                [
                    'label' => "Purchase Order",
                    'backgroundColor' => "rgba(73, 173, 79, 0.2)",
                    'borderColor' => "rgb(73, 173, 79)",
                    'pointBackgroundColor' => "rgb(73, 173, 79)",
                    'pointBorderColor' => "#fff",
                    'pointHoverBackgroundColor' => "#fff",
                    'pointHoverBorderColor' => "rgba(179,181,198,1)",
                    'data' => [$jan/1000,$feb/1000,$mar/1000,80,90,100,110,120,130,140,150,160]
                ],
            ]
        ]
    ]);
    ?>
  </div></div>
  </div>

  <div class="col-sm-3">
    <div class="box bg-green"><div class="box-body">
      <h2 style="text-align:center;font-weight: bold;" class="text-white"><i>I NEVER <br> DREAMED <br> ABOUT <br> SUCCESS,<br> I WORK <br>FOR IT</i></h2>
      <h5 style="text-align:center;font-weight: bold;" class="text-white"><i>- NaVi Team -</i></h5>
    </div></div>
  </div>
</div>

</section>

</div>
