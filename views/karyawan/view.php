<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Karyawan */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Karyawans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="karyawan-view">

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
            'badge',
            'nama',
            'gender',
            'tempat_lahir',
            'tanggal_lahir',
            'no_hp',
            'no_ktp',
            'alamat_ktp',
            'alamat_rumah',
            'pendidikan',
            'status_kawin',
            'tanggal_masuk',
            'posisi',
            'departemen',
            'bank',
            'no_rekening',
            'nama_rekening',
            'status_aktif',
        ],
    ]) ?>

</div>
