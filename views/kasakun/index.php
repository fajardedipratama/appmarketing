<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\KasakunSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Akun/Kategori';
?>
<div class="kas-akun-index">

<div class="row">
    <div class="col-sm-9">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <div class="col-sm-3">
        <?= Html::a('<i class="fa fa-fw fa-plus-square"></i> Tambah Data', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<i class="fa fa-fw fa-book"></i> Kas', ['/kas'], ['class' => 'btn btn-warning']) ?>
    </div>
</div>
<div class="box"><div class="box-body"><div class="table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'kode',
            'kategori',
            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'Detail',
                'template'=>'{update}',
            ],
        ],
    ]); ?>
</div></div></div>

</div>
