<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\PermitSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cuti & Izin';

?>
<div class="permit-index">

    <div class="row">
        <div class="col-sm-9">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-sm-3">
            <?= Html::a('<i class="fa fa-fw fa-plus-square"></i> Tambah Data', ['create'], ['class' => 'btn btn-success']) ?>
        <?php if(Yii::$app->user->identity->type == 'Administrator'): ?>
            <?= Html::a('<i class="fa fa-fw fa-key"></i> User Akses', ['/permitaccess'], ['class' => 'btn btn-danger']) ?>
        <?php endif; ?>
        </div>
    </div>

<div class="box"><div class="box-body"><div class="table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'tgl_izin',
            'karyawan_id',
            'kategori',
            'status',
            ['header'=>'Aksi','class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div></div></div>

</div>
