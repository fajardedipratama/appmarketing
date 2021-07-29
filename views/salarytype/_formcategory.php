<?php
use app\models\SalaryCategory;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $datacategory app\models\SalaryHubtype */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="salary-hubtype-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($datacategory, 'salary_category')->dropDownList(
        ArrayHelper::map(SalaryCategory::find()->all(),'id',
            function($model){
                return $model['nama'];
            }
    )); ?>
    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
