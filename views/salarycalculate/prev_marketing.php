<?php
use app\models\Karyawan;
use app\models\PurchaseOrder;
use app\models\SalaryEmployee;
use app\models\SalaryAdditional;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SalaryCalculate */
$dept_id = $_GET['dept'];

$karyawan = Karyawan::find()->where(['departemen'=>$dept_id])->andWhere(['<=','tanggal_masuk',$model->end_date])->orderBy('nama')->all();

function round_po($value){
    return floor(($value/1000)/5)*5;
}

function bonus_po($value){
    if(($value>=30000) && ($value<50000)){
        return Yii::$app->formatter->asCurrency(750000);
    }elseif(($value>=50000) && ($value<75000)){
        return Yii::$app->formatter->asCurrency(1000000);
    }elseif(($value>=75000) && ($value<100000)){
        return Yii::$app->formatter->asCurrency(1500000);
    }elseif(($value>=100000) && ($value<150000)){
        return Yii::$app->formatter->asCurrency(2000000);
    }elseif(($value>=150000) && ($value<200000)){
        return Yii::$app->formatter->asCurrency(3500000);
    }elseif(($value>=200000) && ($value<250000)){
        return Yii::$app->formatter->asCurrency(5000000);
    }elseif(($value>=250000) && ($value<300000)){
        return Yii::$app->formatter->asCurrency(7500000);
    }elseif(($value>=300000) && ($value<350000)){
        return Yii::$app->formatter->asCurrency(15000000);
    }elseif(($value>=350000) && ($value<400000)){
        return Yii::$app->formatter->asCurrency(17000000);
    }elseif(($value>=400000) && ($value<500000)){
        return Yii::$app->formatter->asCurrency(20000000);
    }elseif(($value>=500000) && ($value<600000)){
        return Yii::$app->formatter->asCurrency(25000000);
    }elseif(($value>=600000) && ($value<700000)){
        return Yii::$app->formatter->asCurrency(35000000);
    }elseif(($value>=700000) && ($value<1000000)){
        return Yii::$app->formatter->asCurrency(50000000);
    }elseif($value>=1000000){
        return Yii::$app->formatter->asCurrency(100000000);
    }
}

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
            <th rowspan="2">Join</th>
            <th rowspan="2">Hari Kerja</th>
            <th colspan="2">Total PO (KL)</th>
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
<?php if($show['tgl_resign']==NULL || $show['tgl_resign']>=$model->begin_date): ?>
    <?php
        $result_po=PurchaseOrder::find()->where(['sales'=>$show['id']])->andWhere(['between','tgl_kirim',$model->begin_date,$model->end_date])->andWhere(['status'=>['Terkirim','Terbayar-Selesai']])->sum('volume');
        $cod_a=PurchaseOrder::find()->where(['sales'=>$show['id']])->andWhere(['between','tgl_kirim',$model->begin_date,$model->end_date])->andWhere(['termin'=>['Cash On Delivery','Cash Before Delivery']])->andWhere(['tgl_lunas'=>'jatuh_tempo'])->sum('volume');
        // $pot_absen = SalaryAdditional::find()->where(['karyawan_id'=>$show['id'],'komponen_id'=>4])->andWhere(['between','tanggal',$model->begin_date,$model->end_date])->one();
    ?>
        <tr>
            <td><?= $i++ ?></td>
            <td><?= $show['nama'] ?></td>
            <td><?= date('d/m/Y',strtotime($show['tanggal_masuk'])) ?></td>
            <td>-</td>
            <td><?= $result_po/1000 ?></td>
            <td><?= round_po($result_po) ?></td>
            <td>
                <?php if($result_po <= 34000){
                    echo Yii::$app->formatter->asCurrency(1500000);
                }elseif($result_po <= 49000){
                    echo Yii::$app->formatter->asCurrency(2000000);
                }elseif($result_po >= 50000){
                    echo Yii::$app->formatter->asCurrency(3000000);
                }

                ?>
            </td>
            <td>-</td>
            <td>
                <?php if( round_po($result_po) >= 5 && round_po($result_po) <= 34){
                    echo Yii::$app->formatter->asCurrency( (round_po($result_po)/5)*125000 );
                }?>     
            </td>
            <td>
                <?php if( round_po($result_po) >= 35 && round_po($result_po) <= 49){
                    echo Yii::$app->formatter->asCurrency( (round_po($result_po)/5)*130000 );
                }?> 
            </td>
            <td>
                <?php if( round_po($result_po) >= 50 && round_po($result_po) <= 99){
                    echo Yii::$app->formatter->asCurrency( (round_po($result_po)/5)*135000 );
                }?>
            </td>
            <td>
                <?php if( round_po($result_po) >= 100){
                    echo Yii::$app->formatter->asCurrency( (round_po($result_po)/5)*200000 );
                }?>
            </td>
            <td><?= bonus_po($result_po) ?></td>
            <td><?= $cod_a ?></td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td><?= $show['no_rekening'].' '.$show['nama_rekening'] ?></td>

        </tr>
<?php endif ?>
    <?php endforeach ?>
    </table>
    </div></div></div>
</div>
