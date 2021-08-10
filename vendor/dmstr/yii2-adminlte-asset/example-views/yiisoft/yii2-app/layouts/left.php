<?php 
use app\models\Karyawan;
use app\models\Jobtitle;

$karyawan = Karyawan::find()->where(['id'=>Yii::$app->user->identity->profilname])->one();
$jobtitle = Jobtitle::find()->where(['id'=>$karyawan['posisi']])->one();

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

                <a href="#"><i class="fa fa-circle text-success"></i> <?= $jobtitle['posisi'] ?></a>
            </div>
        </div>

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    [
                        'label' => 'Keuangan',
                        'icon' => 'money',
                        'url' => '#',
                        'visible' => !Yii::$app->user->isGuest && Yii::$app->user->identity->type == 'Administrator',
                        'items' => [
                            ['label' => 'Gaji Karyawan', 'icon' => 'book', 'url' => ['/salaryemployee'], 'active'=>in_array(\Yii::$app->controller->id,['salaryemployee'])],
                            ['label' => 'Tambahan & Potongan', 'icon' => 'book', 'url' => ['/salaryadditional'], 'active'=>in_array(\Yii::$app->controller->id,['salaryadditional'])],
                            ['label' => 'Kalkulasi Gaji', 'icon' => 'book', 'url' => ['/salarycalculate'], 'active'=>in_array(\Yii::$app->controller->id,['salarycalculate'])],
                            ['label' => 'Tipe Gaji', 'icon' => 'book', 'url' => ['/salarytype'], 'active'=>in_array(\Yii::$app->controller->id,['salarytype'])],
                            ['label' => 'Komponen Gaji', 'icon' => 'book', 'url' => ['/salarycategory'], 'active'=>in_array(\Yii::$app->controller->id,['salarycategory'])],
                        ],
                    ],
                    [
                        'label' => 'Manajemen SDM',
                        'icon' => 'user-secret',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Data Karyawan', 'icon' => 'users', 'url' => ['/karyawan'], 'active'=>in_array(\Yii::$app->controller->id,['karyawan','exkaryawan'])],
                            ['label' => 'Jabatan', 'icon' => 'briefcase', 'url' => ['/jobtitle'], 'active'=>in_array(\Yii::$app->controller->id,['jobtitle'])],
                            ['label' => 'Departemen', 'icon' => 'building', 'url' => ['/departemen'], 'active'=>in_array(\Yii::$app->controller->id,['departemen'])],
                            ['label' => '.'],
                            [
                                'label' => 'User Login', 'icon' => 'key', 'url' => ['/users'], 'active'=>in_array(\Yii::$app->controller->id,['users']),
                                'visible' => !Yii::$app->user->isGuest && Yii::$app->user->identity->type == 'Administrator'
                            ],
                        ],
                        'visible' => !Yii::$app->user->isGuest && Yii::$app->user->identity->type == 'Administrator' || Yii::$app->user->identity->type == 'Manajemen'
                    ],
                    [
                        'label' => 'Marketing',
                        'icon' => 'line-chart',
                        'url' => '#',
                        'items' => [
                            [
                                'label' => 'Data Sales', 'icon' => 'user-secret', 'url' => ['/selfcustomer'], 'active'=>in_array(\Yii::$app->controller->id,['selfcustomer']),
                                'visible' => !Yii::$app->user->isGuest && Yii::$app->user->identity->type == 'Marketing'
                            ],
                            ['label' => 'Data Perusahaan', 'icon' => 'institution', 'url' => ['/customer'], 'active'=>in_array(\Yii::$app->controller->id,['customer','expired'])],
                            [
                                'label' => 'Data Penawaran', 'icon' => 'paste', 'url' => '#',
                                'items' => [
                                    ['label' => 'Selesai', 'icon' => 'check-square-o', 'url' => ['/offerfinish'], 'active'=>in_array(\Yii::$app->controller->id,['offerfinish'])],
                                    [
                                        'label' => 'Proses', 'icon' => 'spinner', 'url' => ['/offerproses'], 'active'=>in_array(\Yii::$app->controller->id,['offerproses']),
                                        'visible' => !Yii::$app->user->isGuest && Yii::$app->user->identity->type == 'Administrator'
                                    ],
                                    ['label' => 'Baru', 'icon' => 'edit', 'url' => ['/offer'], 'active'=>in_array(\Yii::$app->controller->id,['offer'])],
                                ],
                            ],
                            ['label' => 'Data PO', 'icon' => 'cart-plus', 'url' => ['/purchaseorder'], 'active'=>in_array(\Yii::$app->controller->id,['purchaseorder'])],
                            [
                                'label' => 'Kirim Sampel', 'icon' => 'flask', 'url' => ['/sendsample'], 'active'=>in_array(\Yii::$app->controller->id,['sendsample']),
                            ],
                            ['label' => '.'],
                            ['label' => 'Aktivitas Sales', 'icon' => 'table', 'url' => ['/dailyreport','waktu'=>date('Y-m-d')], 'active'=>in_array(\Yii::$app->controller->id,['dailyreport'])],
                            [
                                'label' => 'Statistik Sales', 'icon' => 'table', 'url' => ['/statistic'], 'active'=>in_array(\Yii::$app->controller->id,['statistic']),
                                'visible' => !Yii::$app->user->isGuest && Yii::$app->user->identity->type == 'Administrator' || Yii::$app->user->identity->type == 'Manajemen'
                            ],
                            ['label' => '.'],
                            [
                                'label' => 'Kabupaten/Kota', 'icon' => 'map-marker', 'url' => ['/city'], 'active'=>in_array(\Yii::$app->controller->id,['city']),
                                'visible' => !Yii::$app->user->isGuest && Yii::$app->user->identity->type == 'Administrator' || Yii::$app->user->identity->type == 'Manajemen'
                            ],
                        ],
                    ],
                ],
            ]
        ) ?>

    </section>

</aside>
