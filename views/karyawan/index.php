<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Karyawans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="karyawan-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Karyawan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'badge',
            'nama',
            'gender',
            'tempat_lahir',
            //'tanggal_lahir',
            //'no_hp',
            //'no_ktp',
            //'alamat_ktp',
            //'alamat_rumah',
            //'pendidikan',
            //'status_kawin',
            //'tanggal_masuk',
            //'posisi',
            //'departemen',
            //'bank',
            //'no_rekening',
            //'nama_rekening',
            //'status_aktif',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
