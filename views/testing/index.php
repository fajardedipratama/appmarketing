<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Testings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="testing-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Testing', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


<?php
    $start_date = '2015-06-01';
    $end_date = '2015-06-30';

    while (strtotime($start_date) <= strtotime($end_date)) {
        echo $start_date.'<br>';
        $start_date = date ("Y-m-d", strtotime("+1 days", strtotime($start_date)));
    }
?>


</div>
