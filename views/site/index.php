<?php
use app\assets\AdminLtePluginAsset;
use yii\helpers\Url;

AdminLtePluginAsset::register($this);
//use app\assets\AppAsset;


/* @var $this yii\web\View */

$this->title = 'Timeline';
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- Content Wrapper. Contains page content -->

<!-- Content Header (Page header) -->
<section class="content-header box-header">
    <h1>
        Timeline
        <small>Fenomenom</small>
    </h1>
</section>

<!-- Main content -->
<section class="content">

    <!--    Jumlah Fenomena yang masuk dan diverifikasi-->
    <?php
    $fenomenaCount = \app\models\Fenomena::find()->count();
    $verifCount = \app\models\Fenomena::find()->where(['is_verified' => 1])->count();
    $percent = floor($verifCount * 100 / $fenomenaCount);
    ?>
    <div class="row">
        <div class="col-md-6">
            <div class="box">
                <?php echo \insolita\wgadminlte\LteInfoBox::widget([
                    'bgIconColor' => 'bg-green',
                    'bgColor' => 'green',
                    'number' => $fenomenaCount,
                    'text' => 'Fenomena',
                    'icon' => 'fa fa-pencil-square-o',
                    'showProgress' => true,
                    'progressNumber' => $percent,
                    'description' => $percent . '% Terferivikasi'
                ]) ?>
            </div>
        </div>


        <div class="col-md-6">
                <!--    Top contributor disini-->
                <?php
                $connection = Yii::$app->getDb();
                $command = $connection->createCommand("
        select user_profil.nama, count(t_fenomena.author) as jumlah
        from t_fenomena, user_profil, user
        where t_fenomena.author= user.id and user.username=user_profil.username
        group by t_fenomena.author
        order by count(t_fenomena.author) desc
        limit 5
        ");

                $rows = $command->queryAll();
                \insolita\wgadminlte\CollapseBox::begin([
                    'type'=>\insolita\wgadminlte\LteConst::TYPE_WIDGET,
//                    'isSolid'=>true,
                    'title'=>'Top Contributor',
                    'collapseDefault'=>false,
                ]);
                //        print_r($rows)

                echo \kartik\helpers\Enum::array2table($rows);
                \insolita\wgadminlte\CollapseBox::end();

                ?>
<!--            </div>-->
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <!-- The time line -->
            <ul class="timeline">
                <!-- timeline time label -->
                <li class="time-label">
                  <span class="bg-red">
                    26 April 2017
                  </span>
                </li>
                <!-- /.timeline-label -->
                <!-- timeline item -->
                <li>


                    <div class="box box-widget">
                        <div class="box-header with-border">
                            <div class="user-block">
                                <img class="img-circle" src="<?= Yii::$app->request->baseUrl ?>/roufiq.png"
                                     alt="User Image">
                                <span class="username"><a href="#">Moh. Roufiq Azmy</a></span>
                                <span class="description">Shared publicly - 7:30 PM Today</span>
                            </div>

                            <div class="box-tools">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                        class="fa fa-times"></i></button>
                            </div>
                        </div>

                        <div class="box-body">
                            Kapal Meulaboh Batal Berlayar
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt
                            ut labore et dolore magna aliqua.
                            Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                            commodo consequat.
                            Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                            pariatur.
                            Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit
                            anim id est laborum.​​
                        </div>
                        <div class="box-footer">
                            <a class="btn btn-primary btn-xs">Read more</a>
                            <a class="btn btn-danger btn-xs">Delete</a>
                        </div>
                    </div>
                </li>
                <!-- END timeline item -->
                <!-- timeline item -->
                <li>
                    <i class="fa fa-user bg-aqua"></i>

                    <div class="timeline-item">

                        <span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>

                        <h3 class="timeline-header no-border"><a href="#">Administrator</a> memverifikasi Fenomena</h3>

                        <div class="attachment-block clearfix">
                            <img class="attachment-img" src="<?= Yii::$app->request->baseUrl ?>/Gadang.jpg"
                                 alt="Attachment Image">

                            <div class="attachment-pushed">
                                <h4 class="attachment-heading"><a href="http://www.lipsum.com/">Lorem ipsum text
                                        generator</a></h4>

                                <div class="attachment-text">
                                    Description about the attachment can be placed here.
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry... <a
                                        href="#">more</a>
                                </div>
                                <!-- /.attachment-text -->
                            </div>
                            <!-- /.attachment-pushed -->
                        </div>
                        <div class="timeline-footer">
                            <a class="btn btn-primary btn-xs">Read more</a>
                            <a class="btn btn-danger btn-xs">Delete</a>
                        </div>
                    </div>
                    <!--                            Batas Timeline 1-->
                </li>
                <!-- END timeline item -->
                <!-- timeline item -->
                <li>
                    <i class="fa fa-comments bg-yellow"></i>

                    <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>

                        <h3 class="timeline-header"><a href="#">Djamaluddin</a> membuat Artikel Fenomena</h3>

                        <div class="timeline-body">
                            TE EN URUSAN O
                        </div>
                        <div class="timeline-footer">
                            <a class="btn btn-primary btn-xs">Read more</a>
                            <a class="btn btn-danger btn-xs">Delete</a>
                        </div>
                    </div>
                </li>
                <!-- END timeline item -->
                <!-- timeline time label -->
                <li class="time-label">
                  <span class="bg-green">
                    21 April 2017
                  </span>
                </li>
                <!-- /.timeline-label -->
                <!-- timeline item -->

                <!-- END timeline item -->
                <!-- timeline item -->

                <!-- END timeline item -->
                <li>
                    <i class="fa fa-clock-o bg-gray"></i>
                </li>
            </ul>
        </div>
        <!-- /.col -->
    </div>

    <!-- /.row -->


    <!-- /.form-group -->


    <!-- /.tab-pane -->

    <!-- ./wrapper -->
<!--    --><?php
//    $timeline_items = [];
//    for ($i = 0; $i < 5; $i++) {
//        $time = (time() - mt_rand(3600, 3600 * 24 * 7 * 30 * 5));
//        $objcnt = mt_rand(1, 6);
//        $events = [];
//        for ($j = 0; $j < $objcnt; $j++) {
//            $isFoot = mt_rand(0, 1);
//            $footer = 'something in foot ' . $i . '_' . $j;
//            $obj = Yii::createObject(
//                [
//                    'class' => \insolita\wgadminlte\ExampleTimelineItem::className(),  //Example of customization TimelineItem Object
//                    'time' => $time - mt_rand(0, 3600 * 11),
//                    'header' => 'HEADER NUMBER ' . $i . '_' . $j,
//                    'body' => 'Well, i`m informative body ' . $i . '_' . $j,
//                    'type' => mt_rand(0, 1),
//                    'footer' => $isFoot ? $footer : ''
//                ]
//            );
//            $events[] = $obj;
//        }
//        $timeline_items[$time] = $events;
//    }
//
//
//    //Next we can show its in our widget
//
//    echo \insolita\wgadminlte\Timeline::widget(
//        [
//            'defaultDateBg' => function ($data) {
//                $d = date('j', $data);
//                if ($d <= 10) {
//                    return \insolita\wgadminlte\Timeline::TYPE_FUS;
//                } elseif ($d <= 20) {
//                    return \insolita\wgadminlte\Timeline::TYPE_MAR;
//                } else {
//                    return \insolita\wgadminlte\Timeline::TYPE_PURPLE;
//                }
//            },
//            'items' => $timeline_items,
//            'dateFunc' => function ($data) {
//                return date('d.m, Y', $data);
//            }
//        ]
//    );
//    ?>




