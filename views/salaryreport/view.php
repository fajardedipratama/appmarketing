<?php
use app\models\Departemen;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SalaryCalculate */

$departemen = Departemen::find()->all();

$this->title = "Detail";
\yii\web\YiiAsset::register($this);
?>
<div class="salary-calculate-view">

    <h1>
        <?= Html::a('<i class="glyphicon glyphicon-chevron-left"></i>', ['index'], ['class' => 'btn btn-success']) ?>
        <?= Html::encode($this->title) ?>
    </h1>
    <h5>Periode <?= $model->bulan.'-'.$model->tahun ?></h5>

    <div class="box"><div class="box-body"><div class="table-responsive">
    <h4>Laporan Absensi</h4>
    <table class="table table-bordered">
        <tr>
            <th width="75%">Departemen</th>
            <th>Aksi</th>
        </tr>
        <tr>
            <td>All Department</td>
            <td>
                <?= Html::a('<i class="fa fa-fw fa-eye"></i>', ['previewabsen','period'=>$model->id]) ?>
                <?= Html::a('<i class="fa fa-fw fa-file-excel-o"></i>', ['exportabsensi','period'=>$model->id]) ?>
            </td>
        </tr>
    </table>
    <h4>Laporan Gaji</h4>
    <table class="table table-bordered">
        <tr>
            <th width="75%">Departemen</th>
            <th>Aksi</th>
        </tr>
    <?php foreach($departemen as $show): ?>
        <tr>
            <td><?= $show['departemen'] ?></td>
            <td>
                <?= Html::a('<i class="fa fa-fw fa-eye"></i>', ['preview','period'=>$model->id,'dept'=>$show['id']]) ?>
                <i class="fa fa-fw fa-file-excel-o"></i>
            </td>
        </tr>
    <?php endforeach ?>
    </table>
    </div></div></div>
</div>
