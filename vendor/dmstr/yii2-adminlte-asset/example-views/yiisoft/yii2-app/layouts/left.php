<?php 
use app\models\Karyawan;

$karyawan = Karyawan::find()->where(['id'=>Yii::$app->user->identity->profilname])->one();

?>
<aside class="main-sidebar" style="position: fixed;">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="photos/employee/<?= $karyawan['foto_karyawan'] ?>" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?= $karyawan['nama'] ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    [
                        'label' => 'Manajemen SDM',
                        'icon' => 'user-secret',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Data Karyawan', 'icon' => 'users', 'url' => ['/karyawan'], 'active'=>in_array(\Yii::$app->controller->id,['karyawan','exkaryawan'])],
                            ['label' => 'Jabatan', 'icon' => 'briefcase', 'url' => ['/jobtitle'], 'active'=>in_array(\Yii::$app->controller->id,['jobtitle'])],
                            ['label' => 'Departemen', 'icon' => 'building', 'url' => ['/departemen'], 'active'=>in_array(\Yii::$app->controller->id,['departemen'])],
                            ['label' => '.'],
                            ['label' => 'User Karyawan', 'icon' => 'user', 'url' => ['/users'], 'active'=>in_array(\Yii::$app->controller->id,['users'])],
                        ],
                    ],
                    [
                        'label' => 'Marketing',
                        'icon' => 'line-chart',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Kontak Perusahaan', 'icon' => 'phone', 'url' => ['/customer'], 'active'=>in_array(\Yii::$app->controller->id,['customer'])],
                        ],
                    ],
                ],
            ]
        ) ?>

    </section>

</aside>
