<?php
use dosamigos\datepicker\DatePicker;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\HolidaySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Hari Libur';

?>
<div class="holiday-index">

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
                'format'=>['date', 'dd-MM-Y'],
                'filter'=> DatePicker::widget([
                    'model'=>$searchModel,'attribute'=>'tanggal','clientOptions'=>[
                      'autoclose'=>true, 'format' => 'dd-mm-yyyy','orientation'=>'bottom'
                    ],
                ]),
            ],
            'nama_hari',

            ['header'=>'Aksi','class' => 'yii\grid\ActionColumn','template'=>'{update} {delete}'],
        ],
    ]); ?>
    </div></div></div>

</div>
