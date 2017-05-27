<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
<!--                Isikan query untuk user profil-->
                <img src="<?= Yii::$app->request->baseUrl ?>/<?=$model->photo ?>" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">

                <p><?= $model->nama?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
<!--        <form action="#" method="get" class="sidebar-form">-->
<!--            <div class="input-group">-->
<!--                <input type="text" name="q" class="form-control" placeholder="Search..."/>-->
<!--              <span class="input-group-btn">-->
<!--                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>-->
<!--                </button>-->
<!--              </span>-->
<!--            </div>-->
<!--        </form>-->
        <!-- /.search form -->
        <?php
        $kuartal=ceil(date('n', time()) / 3);
//        $kuartal=2;
        $tahun= date("Y");
        ?>
<!--        --><?php //\yii\widgets\Pjax::begin(['id'=>'menu-pjax']) ?>
        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Menu Yii2', 'options' => ['class' => 'Daftar Menu']],
//                    ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
//                    ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    [
                        'label'=>'Fenomena Ekonomi',
                        'url'=>'#',
                        'icon'=>'circle-o text-aqua',
                        'items'=>
                            [
                                ['label' => '<span>Daftar Artikel</span><span class="pull-right-container"><small class="label pull-right bg-yellow">' . $art . '</small></span>',
                                 'icon' => 'pencil-square', 'url' => ['/fenomena/index'],
                                    'encode' => false,
                                ],
                                ['label' => '<span>Daftar Verifikasi</span><span class="pull-right-container"><small class="label pull-right bg-blue">' . $ver . '</small></span>',
                                    'icon' => 'check', 'url' => ['/fenomena/verified'],
                                    'encode' => false,
                                    'visible'=> ($model->username=='admin'),
                                ],
                            ],
                    ],
                    [   'label'=>'Rekap Fenomena Ekonomi',
                        'url'=> '#',
                        'items'=>[
                            ['label' => 'Lapangan Usaha', 'icon' => 'table', 'url' => ['/rekap-fenomena/index?RekapFenomenaSearch[tahun]='.$tahun.
                                '&RekapFenomenaSearch[triwulan]='.$kuartal.
                                '&RekapFenomenaSearch[id_pdrb]=1'
                            ]],
                            ['label' => 'Pengeluaran', 'icon' => 'table', 'url' => ['/rekap-fenomena/index?RekapFenomenaSearch[tahun]='.$tahun.
                                '&RekapFenomenaSearch[triwulan]='.$kuartal.
                                '&RekapFenomenaSearch[id_pdrb]=2'
                            ]],

                        ]
                    ],
                    [
                        'label'=> 'Mimin',
                        'icon' => 'gears',
                        'url'=>'#',
                        'visible'=> ($model->username=='admin'),
                        'items' =>[
                            ['label' => 'Routing', 'icon' => 'link', 'url' => ['/mimin/route'],],
                            ['label' => 'Role', 'icon' => 'user-secret', 'url' => ['/mimin/role'],],
                            ['label' => 'Daftar Pengguna', 'icon' => 'users', 'url' => ['/mimin/user'],],
                            ['label' => 'Register Operator','icon'=>'user-plus', 'url' => ['/site/signup']],
                        ],
                    ],

                    [
                        'label' => 'Data Master',
                        'icon' => 'database',
                        'url' => '#',
                        'visible'=> ($model->username=='admin'),
                        'items' => [
                            ['label' => 'PDRB', 'icon' => 'file-code-o', 'url' => ['/m-pdrb/index'],],
                            ['label' => 'Kategori PDRB', 'icon' => 'file-code-o', 'url' => ['/m-kategori-pdrb/index'],],
                            ['label' => 'Sub-Kategori PDRB', 'icon' => 'file-code-o', 'url' => ['/m-subkategori/index'],],
                        ],
                    ],
//                    ['label' => 'Logout', 'icon'=>'power-off','url' => ['/site/logout'], 'linkOptions'=>['data'=>['method' => 'post']]],
                ],
            ]
        );

        ?>
<!--        --><?php //\yii\widgets\Pjax::end()?>

    </section>

</aside>
