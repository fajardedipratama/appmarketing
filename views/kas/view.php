<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Kas */

$this->title = 'Kas '.$model->bulan.'/'.$model->tahun;
\yii\web\YiiAsset::register($this);
?>
<div class="kas-view">

<div class="row">
    <div class="col-sm-10">
        <h1><?= Html::encode($this->title) ?></h1>
        <button class="btn btn-danger"><i class="fa fa-fw fa-money"></i> Saldo : <?= Yii::$app->formatter->asCurrency($model->saldo); ?></button>
    </div>
    <div class="col-sm-2">
        <button class="btn btn-success" data-toggle="modal" data-target="#input-detail"><i class="fa fa-fw fa-plus-square"></i> Tambah Data</button>
    </div>
</div>
    

<div class="box box-success" style="margin-top:1%"><div class="box-body"><div class="table-responsive">

</div></div></div>

    <div class="modal fade" id="input-detail"><div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>Tambah Data</b></h4>          
            </div>
            <div class="modal-body">
              <?= $this->render('_formdetail', ['newModel' => $newModel]) ?>
            </div>
        </div>
    </div></div>

</div>
