<?php
use yii\helpers\Html;
use yii\grid\GridView;
use app\models\AttendanceSchedule;
use app\models\AttendanceData;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\AttendancedataSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Absensi Harian';

?>
<div class="attendance-data-index">

    <div class="row">
        <div class="col-sm-9">
            <h1><?= Html::encode($this->title) ?></h1>
            <h5 style="font-style: italic;">Tanggal <?= date('d/m/Y',strtotime($_GET['work_date'])) ?></h5>
        </div>
        <div class="col-sm-3">
        <?php if(Yii::$app->user->identity->type == 'Administrator'): ?>
            <button class="btn btn-primary" data-toggle="modal" data-target="#searchglobal"><i class="fa fa-fw fa-search"></i> Cari</button>
            <?= Html::a('<i class="fa fa-fw fa-calendar"></i> Jadwal Kerja', ['attendanceschedule/index'], ['class' => 'btn btn-success']) ?>
        <?php endif; ?>
        </div>
    </div>
<div class="box"><div class="box-body"><div class="table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'header'=>'Karyawan',
                'attribute'=>'nama_pendek',
            ],
            [
                'header'=>'Jadwal',
                'value'=>function(){
                    $result = AttendanceSchedule::find()->where(['hari'=>date('l',strtotime($_GET['work_date']))])->one();
                    return $result['jam_masuk'].'-'.$result['jam_pulang'];
                }
            ],
            ['header'=>'Absensi'],
            [
                
                'header'=>'Aksi','class' => 'yii\grid\ActionColumn',
                'headerOptions'=>['style'=>'width:15%'],
                'template' => '{check} {update}',
                'buttons'=> [
                  'check'=>function($url,$model)
                    {
                        $result = AttendanceData::find()->where(['karyawan_id'=>$model->id,'work_date'=>$_GET['work_date']])->count();
                        if($result<1){
                            return Html::a('<i class="fa fa-fw fa-check-square-o"></i> Input',["attendancedata/create",'id'=>$model->id],['class' => 'btn btn-sm btn-success']);
                        }
                    },
                  'update'=>function($url,$model)
                    {
                        $result = AttendanceData::find()->where(['karyawan_id'=>$model->id,'work_date'=>$_GET['work_date']])->count();
                        if($result>0){
                            return Html::a('<i class="fa fa-fw fa-pencil"></i>',["update",'id'=>$model->id]);
                        }
                    }
                ],
            ],
        ],
    ]); ?>
</div></div></div>

<!-- modal -->
    <div class="modal fade" id="searchglobal">
    <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><b>Pencarian Tanggal</b></h4>          
        </div>
        <div class="modal-body">
            <?= $this->render('_search', ['model' => $model]) ?>
        </div>
    </div>
    </div>
    </div>
<!-- modal -->

</div>
