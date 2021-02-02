<aside class="main-sidebar" style="position: fixed;">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <?php if(Yii::$app->user->identity->type === 'Administrator'): ?>
                    <img src="photos/user-admin.png" class="img-circle" alt="User Image"/>
                <?php else: ?>
                    <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
                <?php endif; ?>
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->user->identity->profilname ?></p>

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
                ],
            ]
        ) ?>

    </section>

</aside>
