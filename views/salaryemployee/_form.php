<?php
use app\models\SalaryCategory;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $datasalary app\models\SalaryEmployee */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="salary-employee-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-sm-4">
            <?= $form->field($datasalary, 'komponen_id')->dropDownList(
            ArrayHelper::map(SalaryCategory::find()->where(['role'=>'Fixed'])->all(),'id',
                function($data){
                    return $data['nama'];
                }
            )); ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($datasalary, 'nilai')->textInput(['type'=>'number']) ?>
        </div>
    </div>
    
    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
