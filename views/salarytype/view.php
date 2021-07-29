<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Karyawan;
use app\models\SalaryHubtype;
use app\models\SalaryCategory;
/* @var $this yii\web\View */
/* @var $model app\models\SalaryType */

$result_karyawan = Karyawan::find()->where(['tipe_gaji'=>$model->id,'status_aktif'=>'Aktif'])->all();
$result_kategori = SalaryHubtype::find()->where(['salary_type'=>$model->id])->all();

$this->title = 'Detail "' . $model->type.'"';
\yii\web\YiiAsset::register($this);
?>
<div class="salary-type-view">

    <div class="row">
        <div class="col-sm-9">
          <h1><?= $this->title ?></h1>
        </div>
        <div class="col-sm-3">
          <p>
            <?= Html::a('<i class="fa fa-fw fa-pencil"></i> Ubah', ['update', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
            <?= Html::a('<i class="fa fa-fw fa-trash"></i> Hapus', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => ['confirm' => 'Hapus data ini ?','method' => 'post',],
            ]) ?>
          </p> 
        </div>
    </div>

<section class="content"><div class="nav-tabs-custom tab-success">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#karyawan" data-toggle="tab">Karyawan</a></li>
        <li><a href="#komponen" data-toggle="tab">Komponen</a></li>
    </ul>

<div class="tab-content">
    <div class="active tab-pane" id="karyawan">
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
            <tr>
                <th>NIP</th>
                <th>Nama</th>
                <th>Aksi</th>
            </tr>
        <?php foreach($result_karyawan as $show): ?>
            <tr>
                <td><?= $show['badge']; ?></td>
                <td><?= $show['nama']; ?></td>
                <td>
                    <a href="index.php?r=karyawan/view&id=<?= $show['id'] ?>"><i class="fa fa-fw fa-eye" title="Detail Karyawan"></i></a>
                </td>
            </tr>
        <?php endforeach ?>
            </table>
        </div>
    </div>
    <div class="tab-pane" id="komponen">
        <div class="box-body table-responsive no-padding">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#add-category"><i class="fa fa-fw fa-plus-square"></i> Kategori</button>
            <table class="table table-hover">
            <tr>
                <th>Komponen Gaji</th>
                <th>Aksi</th>
            </tr>
        <?php foreach($result_kategori as $show): ?>
            <tr>
                <?php $kategori = SalaryCategory::find()->where(['id'=>$show['salary_category']])->one() ?>
                <td><?= $kategori['nama']; ?></td>
                <td><?= $kategori['jenis']; ?></td>
                <td>
                    <?= Html::a('<i class="fa fa-fw fa-times-circle"></i>', ['salarytype/deletehub', 'id' => $show['id']], ['data' => ['confirm' => 'Hapus data ini ?','method' => 'post']]) ?>
                </td>
            </tr>
        <?php endforeach ?>
            </table>
        </div>
    </div>
</div>

</section>

<div class="modal fade" id="add-category"><div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><b>Tambah Komponen Gaji</b></h4>          
        </div>
        <div class="modal-body">
            <?= $this->render('_formcategory', ['datacategory' => $datacategory]) ?>
        </div>
    </div>
</div></div>

</div>
