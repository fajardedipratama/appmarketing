<?php

use yii\helpers\Html;
use yii\grid\GridView;
use dosamigos\datepicker\DatePicker;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\SalaryadditionalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tambahan & Potongan';

?>
<div class="salary-additional-index">

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
            [
              'attribute'=>'tanggal',
              'value' => function($data){
                return $data->tanggal;
              },
              'headerOptions'=>['style'=>'width:15%'],
              'format' => ['date','dd-MM-Y'],
              'filter'=> DatePicker::widget([
                'model'=>$searchModel,'attribute'=>'tanggal','clientOptions'=>[
                  'autoclose'=>true, 'format' => 'dd-mm-yyyy','orientation'=>'bottom'
                ],
              ])
            ],
            [
                'attribute'=>'karyawan_id',
                'value'=>function($data){
                    return $data->karyawan->nama_pendek;
                },
                'filter'=>\kartik\select2\Select2::widget([
                    'model'=>$searchModel,'attribute'=>'karyawan_id','data'=>$karyawan,
                    'options'=>['placeholder'=>'Karyawan'],'pluginOptions'=>['allowClear'=>true]
                ]),
            ],
            [
                'attribute'=>'komponen_id',
                'value'=>function($data){
                    return $data->komponen->nama;
                },
                'filter'=>\kartik\select2\Select2::widget([
                    'model'=>$searchModel,'attribute'=>'komponen_id','data'=>$komponen,
                    'options'=>['placeholder'=>'Komponen'],'pluginOptions'=>['allowClear'=>true]
                ]),
            ],
            [
                'attribute'=>'nilai',
                'format'=>'Currency'
            ],
            'catatan',

            ['header'=>'Aksi','class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div></div></div>

</div>
