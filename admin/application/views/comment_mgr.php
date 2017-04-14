<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'meta.php'; ?>

    <title>悦居后台管理系统 - 发票管理</title>

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

    <!--icheck-->
    <link href="js/iCheck/skins/minimal/minimal.css" rel="stylesheet">
    <link href="js/iCheck/skins/minimal/red.css" rel="stylesheet">

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
    <div class="main-content">

        <!-- header section start-->
        <?php include 'header.php'; ?>
        <!-- header section end-->

        <!-- page heading start-->
        <div class="page-heading">
            <h3>
                评论管理
            </h3>
            <ul class="breadcrumb">
                <li>
                    <a href="#">首页</a>
                </li>
                <li>
                    <a href="#">房源管理</a>
                </li>
                <li class="active"> 评论管理</li>
            </ul>
        </div>
        <!-- page heading end-->

        <!--body wrapper start-->
        <div class="wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel">
                        <header class="panel-heading">
                            评论列表
                            <span class="tools pull-right">
                                <a href="javascript:;" class="fa fa-chevron-down"></a>
                             </span>
                        </header>
                        <div class="panel-body">

                            <div class="adv-table">
                                <table id="example" class="table table-striped table-bordered" cellspacing="0"
                                       width="100%">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>评论时间</th>
                                        <th>评论内容</th>
                                        <th>评论人</th>
                                        <th>评论房源</th>
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
<script id="comment-tpl" type="text/html">
    <?php include 'tpls/comment_tpl.html';?>
</script>


<!-- Placed js at the end of the document so the pages load faster -->
<script src="js/jquery-1.12.4.min.js"></script>
<script src="js/jquery-ui-1.10.3.min.js"></script>
<script src="js/jquery-migrate-1.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/modernizr.min.js"></script>
<script src="js/jquery.nicescroll.js"></script>

<!--datatables script-->
<script src="js/datatables/js/jquery.dataTables.min.js"></script>
<script src="js/datatables/js/dataTables.bootstrap.js"></script>

<!--icheck script-->
<script src="js/iCheck/jquery.icheck.js"></script>

<!--gritter script-->
<script src="js/gritter/js/jquery.gritter.js"></script>

<script src="js/template.js"></script>
<script src="js/jquery.sidepanel.js"></script>

<!--common scripts for all pages-->
<script src="js/scripts.js"></script>

<script>


    $(function(){
        $('#example').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "comment/comment_mgr",
            "columns": [
                {"data": "comm_id"},
                {
                    "width": "130px",
                    "data": "comm_time"
                },
                {
                    "width": "300px",
                    "data": "content"
                },
                {"data": "username"},
                {"data": "title"},
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return '<a href="javascript:;" class="btn-detail">详情 <i class="fa fa-edit"></i></a>';
                    }
                }
            ],
            "columnDefs": [
                {"orderable": false, "targets": [2,3,5]},
                {"className": "clicked-cell", "targets": [2,3,5]}
            ],
            "order": [0, "desc"]
        });



        /*****点击编辑按钮*****/
        $('#example tbody').on('click', '.btn-detail', function () {

            var dataId = $(this).parents('tr').data('id');

            $.sidepanel({
                width: 800,
                title: '评论详情',
                tpl: 'comment-tpl',
                dataSource: 'comment/comment_detail',
                data: {
                    commId: dataId
                },
                callback: function () {
                }
            });
        });

    });
</script>

</body>
</html>
