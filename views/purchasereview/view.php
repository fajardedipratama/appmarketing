<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PurchaseReview */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Purchase Reviews', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="purchase-review-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
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

</div>
