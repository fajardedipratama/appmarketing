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
    <table class="table table-bordered text-center" style="white-space: nowrap;">
        <tr>
            <th rowspan="2">#</th>
            <th rowspan="2">Nama</th>
            <th rowspan="2">Posisi</th>
            <th rowspan="2">Hari Kerja</th>
            <th colspan="2">Total PO</th>
            <th rowspan="2">Gaji</th>
            <th rowspan="2">Gaji (ProRate)</th>
            <th colspan="4">Komisi</th>
            <th rowspan="2">Bonus</th>
            <th colspan="2">PO CBD/COD 50rb</th>
            <th rowspan="2">Bonus CBD/COD 50rb</th>
            <th colspan="2">PO CBD/COD 25rb</th>
            <th rowspan="2">Bonus CBD/COD 25rb</th>
            <th rowspan="2">Potongan Absensi</th>
            <th rowspan="2">Total Diterima</th>
            <th rowspan="2">Rekening (BCA)</th>
        </tr>
        <tr>
            <th>Terkirim</th>
            <th>Terbayar</th>
            <th>5-34KL</th>
            <th>35-49KL</th>
            <th>50-99KL</th>
            <th>>100KL</th>
            <th>Terkirim</th>
            <th>Terbayar</th>
            <th>Terkirim</th>
            <th>Terbayar</th>
        </tr>
    <?php $i = 1; ?>
    <?php foreach($karyawan as $show): ?>
    <?php
        $posisi = Jobtitle::find()->where(['id'=>$show['posisi']])->one(); 
        // $pot_absen = SalaryAdditional::find()->where(['karyawan_id'=>$show['id'],'komponen_id'=>4])->andWhere(['between','tanggal',$model->begin_date,$model->end_date])->one();
    ?>
        <tr>
            <td><?= $i++ ?></td>
            <td><?= $show['nama'] ?></td>
            <td><?= $posisi['posisi'] ?></td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td><?= $show['no_rekening'].' '.$show['nama_rekening'] ?></td>

        </tr>
    <?php endforeach ?>
    </table>
    </div></div></div>
</div>
