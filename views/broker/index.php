<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\BrokerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Broker';
?>
<div class="broker-index">

    <div class="row">
        <div class="col-sm-10">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-sm-2">
        <?php if(Yii::$app->user->identity->type == 'Administrator'): ?>
            <?= Html::a('<i class="fa fa-fw fa-plus-square"></i> Tambah Data', ['create'], ['class' => 'btn btn-success']) ?>
        <?php endif; ?>
        </div>
    </div>

<div class="box"><div class="box-body"><div class="table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'nama',
            'no_hp',
            [
                'class' => 'yii\grid\ActionColumn','header'=>'Aksi',
                'template' => '{update} {delete}',
                'visible' => Yii::$app->user->identity->type == 'Administrator'
            ],
        ],
    ]); ?>
</div></div></div>

</div>
