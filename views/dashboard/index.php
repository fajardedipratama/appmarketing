<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Customer;
use app\models\Offer;
use app\models\PurchaseOrder;
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

    </section>

</div>
