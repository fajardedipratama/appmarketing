<?php
use app\models\SalaryEmployee;
use app\models\SalaryCategory;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SalaryEmployee */

$result_salary = SalaryEmployee::find()->where(['karyawan_id'=>$model->id])->all();

$this->title = 'Detail Gaji "'.$model->nama_pendek.'"';

\yii\web\YiiAsset::register($this);
?>
<div class="salary-employee-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="box box-success"><div class="box-body">
        <?= $this->render('_form', ['datasalary' => $datasalary]) ?>
    </div></div>

    <div class="box"><div class="box-body"><div class="table-responsive">
    <table class="table table-bordered">
      <tr>
        <th>Komponen Gaji</th>
        <th>Nilai</th>
        <th>Aksi</th>
      </tr>
    <?php foreach($result_salary as $show): ?>
    <?php $komponen = SalaryCategory::find()->where(['id'=>$show['komponen_id']])->one(); ?>
      <tr>
        <td><?= $komponen['nama'] ?></td>
        <td><?= Yii::$app->formatter->asCurrency($show['nilai']) ?></td>
        <td>
            <?= Html::a('<i class="fa fa-fw fa-times-circle"></i>', ['delete', 'id' => $show['id']], ['data' => ['confirm' => 'Hapus data ini ?','method' => 'post']]) ?>
        </td>
      </tr>
    <?php endforeach ?>
    </table>
    </div></div>

</div>
