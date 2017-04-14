<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'meta.php'; ?>

    <title>悦居后台管理系统 - 房源列表</title>

    <base href="<?php echo site_url(); ?>">

    <!--bootstrap-->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-reset.css" rel="stylesheet">

    <!--jQuery UI-->
    <link href="css/jquery-ui-1.10.3.css" rel="stylesheet">

    <!--font awesome-->
    <link href="css/font-awesome.min.css" rel="stylesheet">

    <!--datatables-->
    <link href="js/datatables/css/dataTables.bootstrap.min.css" rel="stylesheet">

    <!--gritter-->
    <link href="js/gritter/css/jquery.gritter.css" rel="stylesheet"/>

    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>

<body class="sticky-header">

<section>
    <!-- left side start-->
    <?php include 'sidebar.php'; ?>
    <!-- left side end-->
    
    <!-- main content start-->
    <div class="main-content" >

        <!-- header section start-->
        <?php include 'header.php'; ?>
        <!-- header section end-->

        <!-- page heading start-->
        <div class="page-heading">
            <h3>
                房态图
            </h3>
            <ul class="breadcrumb">
                <li>
                    <a href="#">房源管理</a>
                </li>
                <li class="active">房态图</li>
            </ul>
        </div>
        <!-- page heading end-->

        <!--body wrapper start-->
        <div class="wrapper">
            <div class="directory-info-row">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="panel">
                            <header class="panel-heading">
                                A栋304，哈尔滨梧桐树公寓观景大床房
                                <div style="margin-top: -6px;" class="btn-group pull-right">
                                    <button class="btn btn-success" type="button">续住</button>
                                    <button class="btn btn-info" type="button">结账</button>
                                </div>
                            </header>
                            <div class="panel-body">
                                <div class="media">
                                    <a class="pull-left text-center" href="#">
                                        <img class="thumb media-object" src="uploads/148716736855667.jpg" alt="" width="103" height="103">
                                    </a>
                                    <div class="media-body">
                                        <address>
                                            入住状态：已入住<br>
                                            入住时间：2017-2-12 至 2017-2-18<br>
                                            用户：张三<br>
                                            电话：13098763645
                                        </address>
                                        <ul class="social-links">
                                            <li><a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Facebook"><i class="fa fa-thumbs-up"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6">
                        <div class="panel">
                            <div class="panel-body">
                                <h4>群力哈尔滨故事公寓一室一厅阳光套房</h4>
                                <div class="media">
                                    <a class="pull-left" href="#">
                                        <img class="thumb media-object" src="uploads/148716737586568.jpg" alt="" width="103" height="103">
                                    </a>
                                    <div class="media-body">
                                        <address>
                                            <strong>ABCDE, Inc.</strong><br>
                                            ABC Ave, Suite 14<br>
                                            BucketLand, Australia <br>
                                            <abbr title="Phone">P:</abbr> (123) 456-7890
                                        </address>
                                        <ul class="social-links">
                                            <li><a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Facebook"><i class="fa fa-facebook"></i></a></li>
                                            <li><a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Twitter"><i class="fa fa-twitter"></i></a></li>
                                            <li><a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="LinkedIn"><i class="fa fa-linkedin"></i></a></li>
                                            <li><a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Skype"><i class="fa fa-skype"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6">
                        <div class="panel">
                            <div class="panel-body">
                                <h4>哈西万达禧龙公寓地中海大床房</h4>
                                <div class="media">
                                    <a class="pull-left" href="#">
                                        <img class="thumb media-object" src="uploads/148716738227309.jpg" alt="" width="103" height="103">
                                    </a>
                                    <div class="media-body">
                                        <address>
                                            <strong>ABCDE, Inc.</strong><br>
                                            ABC Ave, Suite 14<br>
                                            BucketLand, Australia <br>
                                            <abbr title="Phone">P:</abbr> (123) 456-7890
                                        </address>
                                        <ul class="social-links">
                                            <li><a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Facebook"><i class="fa fa-facebook"></i></a></li>
                                            <li><a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Twitter"><i class="fa fa-twitter"></i></a></li>
                                            <li><a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="LinkedIn"><i class="fa fa-linkedin"></i></a></li>
                                            <li><a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Skype"><i class="fa fa-skype"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6">
                        <div class="panel">
                            <div class="panel-body">
                                <h4>中央大街荣耀宝宇时尚索菲亚双大床四人</h4>
                                <div class="media">
                                    <a class="pull-left" href="#">
                                        <img class="thumb media-object" src="uploads/201507100243521506_390_390.jpg" alt="" width="103" height="103">
                                    </a>
                                    <div class="media-body">
                                        <address>
                                            <strong>ABCDE, Inc.</strong><br>
                                            ABC Ave, Suite 14<br>
                                            BucketLand, Australia <br>
                                            <abbr title="Phone">P:</abbr> (123) 456-7890
                                        </address>
                                        <ul class="social-links">
                                            <li><a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Facebook"><i class="fa fa-facebook"></i></a></li>
                                            <li><a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Twitter"><i class="fa fa-twitter"></i></a></li>
                                            <li><a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="LinkedIn"><i class="fa fa-linkedin"></i></a></li>
                                            <li><a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Skype"><i class="fa fa-skype"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6">
                        <div class="panel">
                            <div class="panel-body">
                                <h4>中央大街旁 索菲亚附近地中海风情大床房</h4>
                                <div class="media">
                                    <a class="pull-left" href="#">
                                        <img class="thumb media-object" src="uploads/201507100243529488_390_390.jpg" alt="" width="103" height="103">
                                    </a>
                                    <div class="media-body">
                                        <address>
                                            <strong>ABCDE, Inc.</strong><br>
                                            ABC Ave, Suite 14<br>
                                            BucketLand, Australia <br>
                                            <abbr title="Phone">P:</abbr> (123) 456-7890
                                        </address>
                                        <ul class="social-links">
                                            <li><a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Facebook"><i class="fa fa-facebook"></i></a></li>
                                            <li><a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Twitter"><i class="fa fa-twitter"></i></a></li>
                                            <li><a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="LinkedIn"><i class="fa fa-linkedin"></i></a></li>
                                            <li><a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Skype"><i class="fa fa-skype"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6">
                        <div class="panel">
                            <div class="panel-body">
                                <h4>哈西万达大盛公寓欧式大床房</h4>
                                <div class="media">
                                    <a class="pull-left" href="#">
                                        <img class="thumb media-object" src="uploads/201612181552509886_390_390.jpg" alt="" width="103" height="103">
                                    </a>
                                    <div class="media-body">
                                        <address>
                                            <strong>ABCDE, Inc.</strong><br>
                                            ABC Ave, Suite 14<br>
                                            BucketLand, Australia <br>
                                            <abbr title="Phone">P:</abbr> (123) 456-7890
                                        </address>
                                        <ul class="social-links">
                                            <li><a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Facebook"><i class="fa fa-facebook"></i></a></li>
                                            <li><a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Twitter"><i class="fa fa-twitter"></i></a></li>
                                            <li><a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="LinkedIn"><i class="fa fa-linkedin"></i></a></li>
                                            <li><a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Skype"><i class="fa fa-skype"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6">
                        <div class="panel">
                            <div class="panel-body">
                                <h4>中央大街82平复式《北北游子居》可做饭</h4>
                                <div class="media">
                                    <a class="pull-left" href="#">
                                        <img class="thumb media-object" src="uploads/148716736855667.jpg" alt="" width="103" height="103">
                                    </a>
                                    <div class="media-body">
                                        <address>
                                            <strong>ABCDE, Inc.</strong><br>
                                            ABC Ave, Suite 14<br>
                                            BucketLand, Australia <br>
                                            <abbr title="Phone">P:</abbr> (123) 456-7890
                                        </address>
                                        <ul class="social-links">
                                            <li><a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Facebook"><i class="fa fa-facebook"></i></a></li>
                                            <li><a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Twitter"><i class="fa fa-twitter"></i></a></li>
                                            <li><a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="LinkedIn"><i class="fa fa-linkedin"></i></a></li>
                                            <li><a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Skype"><i class="fa fa-skype"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6">
                        <div class="panel">
                            <div class="panel-body">
                                <h4>乐松商圈凯旋广场温馨舒适的两居室</h4>
                                <div class="media">
                                    <a class="pull-left" href="#">
                                        <img class="thumb media-object" src="uploads/148716736855667.jpg" alt="" width="103" height="103">
                                    </a>
                                    <div class="media-body">
                                        <address>
                                            <strong>ABCDE, Inc.</strong><br>
                                            ABC Ave, Suite 14<br>
                                            BucketLand, Australia <br>
                                            <abbr title="Phone">P:</abbr> (123) 456-7890
                                        </address>
                                        <ul class="social-links">
                                            <li><a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Facebook"><i class="fa fa-facebook"></i></a></li>
                                            <li><a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Twitter"><i class="fa fa-twitter"></i></a></li>
                                            <li><a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="LinkedIn"><i class="fa fa-linkedin"></i></a></li>
                                            <li><a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Skype"><i class="fa fa-skype"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6">
                        <div class="panel">
                            <div class="panel-body">
                                <h4>学府四道街 复式豪宅</h4>
                                <div class="media">
                                    <a class="pull-left" href="#">
                                        <img class="thumb media-object" src="uploads/148716736855667.jpg" alt="" width="103" height="103">
                                    </a>
                                    <div class="media-body">
                                        <address>
                                            <strong>ABCDE, Inc.</strong><br>
                                            ABC Ave, Suite 14<br>
                                            BucketLand, Australia <br>
                                            <abbr title="Phone">P:</abbr> (123) 456-7890
                                        </address>
                                        <ul class="social-links">
                                            <li><a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Facebook"><i class="fa fa-facebook"></i></a></li>
                                            <li><a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Twitter"><i class="fa fa-twitter"></i></a></li>
                                            <li><a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="LinkedIn"><i class="fa fa-linkedin"></i></a></li>
                                            <li><a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Skype"><i class="fa fa-skype"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6">
                        <div class="panel">
                            <div class="panel-body">
                                <h4>哈尔滨哈西万达豪华家庭房 </h4>
                                <div class="media">
                                    <a class="pull-left" href="#">
                                        <img class="thumb media-object" src="uploads/148716736855667.jpg" alt="" width="103" height="103">
                                    </a>
                                    <div class="media-body">
                                        <address>
                                            <strong>ABCDE, Inc.</strong><br>
                                            ABC Ave, Suite 14<br>
                                            BucketLand, Australia <br>
                                            <abbr title="Phone">P:</abbr> (123) 456-7890
                                        </address>
                                        <ul class="social-links">
                                            <li><a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Facebook"><i class="fa fa-facebook"></i></a></li>
                                            <li><a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Twitter"><i class="fa fa-twitter"></i></a></li>
                                            <li><a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="LinkedIn"><i class="fa fa-linkedin"></i></a></li>
                                            <li><a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Skype"><i class="fa fa-skype"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!--body wrapper end-->

        <!--footer section start-->
        <footer class="">
            <?php include 'footer.php'; ?>
        </footer>
        <!--footer section end-->


    </div>
    <!-- main content end-->
</section>

<!-- Placed js at the end of the document so the pages load faster -->
<script src="js/jquery-1.10.2.min.js"></script>
<script src="js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="js/jquery-migrate-1.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/modernizr.min.js"></script>
<script src="js/jquery.nicescroll.js"></script>


<!--common scripts for all pages-->
<script src="js/scripts.js"></script>

</body>
</html>
