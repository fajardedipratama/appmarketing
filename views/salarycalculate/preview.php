<?php
use app\models\Karyawan;
use app\models\Jobtitle;
use app\models\SalaryEmployee;
use app\models\SalaryAdditional;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SalaryCalculate */
$dept_id = $_GET['dept'];

$karyawan = Karyawan::find()->where(['departemen'=>$dept_id,'status_aktif'=>'Aktif'])->all();

$this->title = "Preview";
\yii\web\YiiAsset::register($this);
?>
<div class="salary-calculate-view">

    <h1>
        <?= Html::a('<i class="glyphicon glyphicon-chevron-left"></i>', ['view','id'=>$model->id], ['class' => 'btn btn-success']) ?>
        <?= Html::encode($this->title) ?>
    </h1>
    <h5>Periode <?= $model->bulan.'-'.$model->tahun ?></h5>

    <div class="box"><div class="box-body"><div class="table-responsive">
    <table class="table table-bordered">
        <tr>
            <th>#</th>
            <th>Nama</th>
            <th>Posisi</th>
            <th>Gaji</th>
            <th>Potongan Absensi</th>
            <th>Total Diterima</th>
            <th>Rekening (BCA)</th>
        </tr>
    <?php $i = 1; ?>
    <?php foreach($karyawan as $show): ?>
    <?php
        $posisi = Jobtitle::find()->where(['id'=>$show['posisi']])->one(); 
        $gapok = SalaryEmployee::find()->where(['karyawan_id'=>$show['id'],'komponen_id'=>1])->one();
        $pot_absen = SalaryAdditional::find()->where(['karyawan_id'=>$show['id'],'komponen_id'=>4])->andWhere(['between','tanggal',$model->begin_date,$model->end_date])->one();
    ?>
        <tr>
            <td><?= $i++ ?></td>
            <td><?= $show['nama'] ?></td>
            <td><?= $posisi['posisi'] ?></td>
            <td><?= Yii::$app->formatter->asCurrency($gapok['nilai']) ?></td>
            <td>
            <?php
                if($pot_absen){ 
                    echo Yii::$app->formatter->asCurrency($pot_absen['nilai']);
                }else{
                    echo 0;
                }
            ?>        
            </td>
            <td>
            <?php
                if($pot_absen){ 
                    echo Yii::$app->formatter->asCurrency($gapok['nilai']-$pot_absen['nilai']);
                }else{
                    echo Yii::$app->formatter->asCurrency($gapok['nilai']);
                }
            ?>  
            </td>
            <td><?= $show['no_rekening'].' '.$show['nama_rekening'] ?></td>

        </tr>
    <?php endforeach ?>
    </table>
    </div></div></div>
</div>
