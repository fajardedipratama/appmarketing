<?php
use yii\helpers\Html;
use app\models\Karyawan;
use app\models\DailyReport;
use app\models\Customer;

$karyawan = Karyawan::find()->where(['id'=>Yii::$app->user->identity->profilname])->one();

$callback = DailyReport::find()->where(['sales'=>Yii::$app->user->identity->profilname])->andWhere(['pengingat'=>date('Y-m-d')])->all();
/* @var $this \yii\web\View */
/* @var $content string */

?>

<header class="main-header" style="position: fixed;">

    <?= Html::a('<span class="logo-mini">APP</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-fixed-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">
                <?php if(Yii::$app->user->identity->type == 'Marketing'): ?>
                <li class="dropdown notifications-menu" title="Hubungi Balik">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="glyphicon glyphicon-phone-alt"></i>
                        <span class="label label-danger">!</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header"><b>Hubungi Balik Hari Ini</b></li>
                        <li>
                            <ul class="menu">
                            <?php foreach($callback as $notif): ?>
                            <?php $cust=Customer::find()->where(['id'=>$notif['perusahaan']])->one() ?>
                            <?php if(($cust['expired'] >= date('Y-m-d') || $cust['expired'] == NULL) && $cust['verified'] != 'no'): ?>
                                <li>
                                    <a href="index.php?r=selfcustomer/view&id=<?= $cust['id'] ?>">
                                        <i class="fa fa-phone text-aqua"></i> <?= $cust['perusahaan'] ?>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php endforeach ?>
                            </ul>
                        </li>
                    </ul>
                </li>
                <?php endif ?>
                <!-- User Account: style can be found in dropdown.less -->

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="glyphicon glyphicon-user"></i>
                        <span class="hidden-xs"> <?= $karyawan['nama'] ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="photos/employee/<?= $karyawan['foto_karyawan'] ?>" class="img-circle" alt="User Image"/>
                            <p>
                                <?= $karyawan['nama'] ?>
                                <small>@<?= Yii::$app->user->identity->username ?></small>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <!-- <li class="user-body">
                            <div class="col-xs-4 text-center">
                                <a href="#">Followers</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">Sales</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">Friends</a>
                            </div>
                        </li> -->
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <?= Html::a(
                                    'Sign out',
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>

                <!-- User Account: style can be found in dropdown.less -->
                <!-- <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li> -->
            </ul>
        </div>
    </nav>
</header>
