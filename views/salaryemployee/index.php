<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Gaji Karyawan';

?>
<div class="salary-employee-index">

    <h1><?= Html::encode($this->title) ?></h1>
<div class="box"><div class="box-body"><div class="table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'badge',
            'nama',
            [
                'attribute' => 'posisi',
                'value' => 'jobtitle.posisi',
            ],

            ['header'=>'Aksi','class' => 'yii\grid\ActionColumn','template'=>'{view}'],
        ],
    ]); ?>
</div></div></div>

</div>
