<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PurchaseReview */

$this->title = 'Review '.$model->perusahaan;
\yii\web\YiiAsset::register($this);
?>
<div class="purchase-review-view">

    <div class="row">
        <div class="col-sm-10">
            <h1>
                <?= Html::a('<i class="glyphicon glyphicon-chevron-left"></i>', ['/purchasereview'], ['class' => 'btn btn-success']) ?>
                Review <b><?= $model->perusahaan ?></b>
            </h1>
        </div>
        <div class="col-sm-2">
            <?= Html::a('<i class="fa fa-fw fa-pencil"></i> Ubah', ['update', 'id' => $model->id], ['class' => 'btn btn-warning','title'=>'Update']) ?>
        </div>
    </div>

<div class="box box-success"><div class="box-body"><div class="table-responsive">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'perusahaan_id',
            'last_purchase_id',
            'sales_id',
            'waktu_ambil',
            'jarak_ambil',
            'catatan_kirim',
            'catatan_berkas',
            'catatan_bayar',
            'catatan_lain',
            'kendala',
            'review_by',
        ],
    ]) ?>
</div></div></div>
</div>
