<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'meta.php'; ?>

    <title>随心停后台管理系统 - 开发商管理</title>

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

    <link rel="stylesheet" type="text/css" href="css/bootstrap-fileupload.min.css">

    <!--gritter-->
    <link href="js/gritter/css/jquery.gritter.css" rel="stylesheet"/>

    <!--pickers css-->
    <link rel="stylesheet" type="text/css" href="js/bootstrap-datepicker/css/datepicker-custom.css" />


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
    <div class="main-content">

        <!-- header section start-->
        <?php include 'header.php'; ?>
        <!-- header section end-->

        <!-- page heading start-->
        <div class="page-heading">
            <h3>
                开发商管理
            </h3>
            <ul class="breadcrumb">
                <li>
                    <a href="#">首页</a>
                </li>
                <li>
                    <a href="#">房源管理</a>
                </li>
                <li class="active"> 开发商管理</li>
            </ul>
        </div>
        <!-- page heading end-->

        <!--body wrapper start-->
        <div class="wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel">
                        <header class="panel-heading">
                            开发商数据列表
                            <span class="tools pull-right">
                                <a href="javascript:;" class="fa fa-chevron-down"></a>
                             </span>
                        </header>
                        <div class="panel-body">
                            <div class="btn-group">
                                <button id="btn-new" class="btn btn-primary">
                                    添加 <i class="fa fa-plus"></i>
                                </button>
                                <button id="btn-del" class="btn btn-primary" type="button">
                                    删除 <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <div class="adv-table">
                                <div></div>
                                <table class="table table-striped table-bordered" id="developer-table" cellspacing="0"
                                       width="100%">
                                    <thead>
                                    <tr>
                                        <th><input type="checkbox" id="check-all"></th>
                                        <th>ID</th>
                                        <th>开发商logo</th>
                                        <th>开发商名称</th>
                                        <th>地址</th>
                                        <th>电话</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
        <!--body wrapper end-->

        <!--footer section start-->
        <?php include 'footer.php'; ?>
        <!--footer section end-->


    </div>
    <!-- main content end-->
</section>
<!-- templates -->
<script id="developer-tpl" type="text/html">
    <?php include 'tpls/developer_tpl.html'; ?>
</script>
<script id="new-developer-tpl" type="text/html">
    <?php include 'tpls/new_developer_tpl.html'; ?>
</script>
<script id="edit-developer-tpl" type="text/html">
    <?php include 'tpls/edit_developer_tpl.html'; ?>
</script>

<!-- Placed js at the end of the document so the pages load faster -->
<script src="js/jquery-1.10.2.min.js"></script>
<script src="js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="js/jquery-migrate-1.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/modernizr.min.js"></script>
<script src="js/jquery.nicescroll.js"></script>

<!--validate script-->
<script src="js/jquery.validate.min.js"></script>

<!--datatables script-->
<script src="js/datatables/js/jquery.dataTables.min.js"></script>
<script src="js/datatables/js/dataTables.bootstrap.js"></script>

<!-- ueditor 配置文件 -->
<script src="js/ueditor/ueditor.config.js"></script>
<!-- ueditor 编辑器源码文件 -->
<script src="js/ueditor/ueditor.all.min.js"></script>

<script src="js/gritter/js/jquery.gritter.js"></script>

<script src="js/template.js"></script>
<script src="js/jquery.sidepanel.js"></script>

<!--pickers plugins-->
<script type="text/javascript" src="js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<!--common scripts for all pages-->
<script src="js/scripts.js"></script>
<script src="js/bootstrap-fileupload.min.js"></script>
<script src="js/developer_mgr.js"></script>
</body>
</html>
