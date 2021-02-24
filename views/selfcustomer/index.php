<?php

use yii\helpers\Html;
use yii\grid\GridView;
use dosamigos\datepicker\DatePicker;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\SelfCustomerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Sales';

?>
<div class="selfcustomer-index">

    <div class="row">
        <div class="col-sm-10">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-sm-2">
            <?= Html::a('<i class="fa fa-fw fa-plus-square"></i> Tambah Data', ['create'], ['class' => 'btn btn-success']) ?>
        </div>
    </div>

<div class="box"><div class="box-body"><div class="table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'perusahaan',
            [
                'attribute' => 'lokasi',
                'value' => 'city.kota',
                'filter'=>\kartik\select2\Select2::widget([
                    'model'=>$searchModel,'attribute'=>'lokasi','data'=>$kota,
                    'options'=>['placeholder'=>'Lokasi'],'pluginOptions'=>['allowClear'=>true]
                ])
            ],
            'pic',
            'telfon',
            [
              'header'=>'Expired',
              'value' => 'expired',
              'headerOptions'=>['style'=>'width:15%'],
              'format' => ['date', 'dd-MM-Y'],
              'filter'=> DatePicker::widget([
                'model'=>$searchModel,'attribute'=>'expired','clientOptions'=>[
                  'autoclose'=>true, 'format' => 'dd-mm-yyyy','orientation'=>'bottom'
                ],
              ])
            ],
            [
                'class' => 'yii\grid\ActionColumn','header'=>'Aksi',
                'template' => '{view}'
            ],
        ],
    ]); ?>
</div></div></div>

</div>
