<?php
use yii\helpers\Html;
use yii\grid\GridView;
use dosamigos\datepicker\DatePicker;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\DailyreportSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Aktivitas Sales';

?>
<div class="dailyreport-index">

    <div class="row">
        <div class="col-sm-10">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-sm-2">
        <?php if(Yii::$app->user->identity->type != 'Marketing'): ?>
            <?= Html::a('<i class="fa fa-fw fa-file-excel-o"></i> Export Excel', ['export-excel2','waktu'=>$_GET['waktu']], ['class'=>'btn btn-success']); ?>
        <?php endif ?> 
        </div>
    </div>


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
                ]),
                'visible' => Yii::$app->user->identity->type == 'Administrator' || Yii::$app->user->identity->type == 'Manajemen'
            ],
            [
                'attribute'=>'waktu',
                'headerOptions'=>['style'=>'width:15%'],
                'format' => ['date','dd-MM-Y H:i'],
                // 'filter'=> DatePicker::widget([
                //     'model'=>$searchModel,'attribute'=>'waktu','clientOptions'=>[
                //       'autoclose'=>true, 'format' => 'dd-mm-yyyy','orientation'=>'bottom'
                //     ],
                // ])
            ],
            [
              'attribute'=>'perusahaan',
              'value'=>'customer.perusahaan',
              // 'filter'=>\kartik\select2\Select2::widget([
              //   'model'=>$searchModel,'attribute'=>'perusahaan','data'=>$customer,
              //   'options'=>['placeholder'=>'Perusahaan'],'pluginOptions'=>['allowClear'=>true]
              // ])
            ],
            [
                'header' => 'Telfon',
                'value' => 'customer.telfon'
            ],
            'keterangan',
            'catatan',
            'con_used',
        ],
    ]); ?>
</div></div></div>

</div>
