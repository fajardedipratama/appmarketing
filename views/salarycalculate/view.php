<?php
use app\models\Karyawan;
use app\models\SalaryCategory;
use app\models\SalaryEmployee;
use app\models\SalaryAdditional;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SalaryCalculate */

$komponen = SalaryCategory::find()->where(['status'=>'Aktif'])->all();
$karyawan = Karyawan::find()->where(['status_aktif'=>'Aktif'])->all();

$this->title = "Detail Gaji";
\yii\web\YiiAsset::register($this);
?>
<div class="salary-calculate-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <h5>Periode <?= $model->bulan.'-'.$model->tahun ?></h5>

    <div class="box"><div class="box-body"><div class="table-responsive">
    <table class="table table-bordered">
        <tr>
            <th>Karyawan</th>
    <?php foreach($komponen as $show): ?>
            <th><?= $show['nama'] ?></th>
    <?php endforeach ?>
        </tr>
    <?php foreach($karyawan as $show): ?>
        <tr>
            <td><?= $show['nama'] ?></td>
            <?php foreach($komponen as $show2): ?>
                <td>
                <?php
                    if($show2['role']=='Fixed'){ 
                        $gaji = SalaryEmployee::find()->where(['karyawan_id'=>$show['id'],'komponen_id'=>$show2['id']])->all();
                    }elseif($show2['role']=='Additional'){
                        $gaji = SalaryAdditional::find()->where(['karyawan_id'=>$show['id'],'komponen_id'=>$show2['id']])->all();
                    }
                ?>
                <?php foreach($gaji as $show3): ?>
                   <?= Yii::$app->formatter->asCurrency($show3['nilai']) ?>
                <?php endforeach ?>
                </td>
            <?php endforeach ?>
        </tr>
    <?php endforeach ?>
    </table>
    </div></div></div>
</div>
