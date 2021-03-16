<?php
use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Karyawan;
use app\models\Offer;
use app\models\PurchaseOrder;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\OfferSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Statistik Total';


?>
<div class="offer-index">
    <div class="row">
        <div class="col-sm-10">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-sm-2">
            <?= Html::a('<i class="fa fa-fw fa-calendar"></i> Statistik Harian', ['today','time'=>date('Y-m-d')], ['class' => 'btn btn-success']) ?>
        </div>
    </div>

<div class="box"><div class="box-body"><div class="table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'header'=>'Nama Sales',
                'value'=>'nama_pendek',
            ],
            [
                'header'=>'Tanggal Masuk',
                'value'=>function($data){
                    return date('d-M-Y',strtotime($data['tanggal_masuk']));
                }
            ],
            [
                'header'=>'Total Penawaran (Terkirim + Gagal)',
                'value'=>function($data){
                    $success = Offer::find()->where(['sales'=>$data['id']])->andWhere(['status'=>'Terkirim'])->count();
                    $failed = Offer::find()->where(['sales'=>$data['id']])->andWhere(['status'=>'Gagal Kirim'])->count();
                    return $success+$failed.' ('.$success.'+'.$failed.')';
                }
            ],
            [
                'header'=>'Total PO (Disetujui + Ditolak)',
                'value'=>function($data){
                    $success = PurchaseOrder::find()->where(['sales'=>$data['id']])->andWhere(['!=','status','Ditolak'])->count();
                    $failed = PurchaseOrder::find()->where(['sales'=>$data['id']])->andWhere(['status'=>'Ditolak'])->count();
                    return $success+$failed.' ('.$success.'+'.$failed.')';
                }
            ],
            // [
            //     'class' => 'yii\grid\ActionColumn','header'=>'Aksi',
            //     'template' => '{view}'
            // ],
        ],
    ]); ?>
</div></div></div>

</div>
