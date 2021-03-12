<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\DailyreportSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Aktivitas Sales';

?>
<div class="dailyreport-index">

    <h1><?= Html::encode($this->title) ?></h1>

<div class="box"><div class="box-body"><div class="table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'sales',
                'value' => 'karyawan.nama_pendek',
                'filter'=>\kartik\select2\Select2::widget([
                    'model'=>$searchModel,'attribute'=>'sales','data'=>$sales,
                    'options'=>['placeholder'=>'Sales'],'pluginOptions'=>['allowClear'=>true]
                ])
            ],
            'waktu',
            [
              'attribute'=>'perusahaan',
              'value'=>'customer.perusahaan',
              'filter'=>\kartik\select2\Select2::widget([
                'model'=>$searchModel,'attribute'=>'perusahaan','data'=>$customer,
                'options'=>['placeholder'=>'Perusahaan'],'pluginOptions'=>['allowClear'=>true]
              ])
            ],
            [
                'header' => 'Telfon',
                'value' => 'customer.telfon'
            ],
            'keterangan',
            'catatan',
        ],
    ]); ?>
</div></div></div>

</div>
