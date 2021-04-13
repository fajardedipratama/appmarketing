<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Karyawan;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ExkaryawanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ex-Karyawan';

?>
<div class="exkaryawan-index">

    <div class="row">
        <div class="col-sm-10">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-sm-2">
            <?= Html::a('<i class="fa fa-fw fa-users"></i> Karyawan Aktif', ['/karyawan'], ['class' => 'btn btn-success']) ?>
        </div>
    </div>

<div class="box"><div class="box-body"><div class="table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            [
                'header' => 'NIP',
                'value'=>'karyawan.badge',
            ],
            [
                'header' => 'Nama',
                'value'=>'karyawan.nama',
            ],
            'alasan',
            'tgl_resign',

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Aksi',
                'template' => '{view} {update}',
                'visible' => Yii::$app->user->identity->type == 'Administrator',
                'buttons'=> [
                    'view'=>function($url,$model)
                    {
                    return Html::a
                     (
                        '<span class="glyphicon glyphicon-user"></span>',
                        ["karyawan/view",'id'=>$model->id_employee],['title' => Yii::t('app', 'View Profile')]
                     );
                    },
                ],
            ],
        ],
    ]); ?>
</div></div></div>

</div>
