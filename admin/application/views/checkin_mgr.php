<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'meta.php'; ?>

    <title>悦居后台管理系统 - 入住管理</title>

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
                订单管理
            </h3>
            <ul class="breadcrumb">
                <li>
                    <a href="#">首页</a>
                </li>
                <li>
                    <a href="#">订单管理</a>
                </li>
                <li class="active"> 入住管理</li>
            </ul>
        </div>
        <!-- page heading end-->

        <!--body wrapper start-->
        <div class="wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel">
                        <header class="panel-heading">
                            入住数据列表
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
                                        <th>编号</th>
                                        <th>预订方式</th>
                                        <th>房源名称</th>
                                        <th>入住时间</th>
                                        <th>离开时间</th>
                                        <th>订单状态</th>
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
<script id="checkin-detail-tpl" type="text/html">
    <?php include 'tpls/checkin_detail_tpl.html';?>
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
    /**
     * Created by apple on 17/2/11.
     */
    $(function(){


        $('#example').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "order/checkin_mgr",
            "columns": [
                {"data": "order_id"},
                {"data": "order_type"},
                {"data": "title"},
                {"data": "start_time"},
                {"data": "end_time"},
                {"data": "status"},
                {
                    "targets": -1,
                    "data": null,
                    "render": function (data, type, row) {
                        return '<a href="javascript:;" class="btn-detail" data-id="' + row.order_id + '">详情</a>';
                    }
                }
            ],
            "columnDefs": [
                {"orderable": false, "targets": [6]},
                {"className": "clicked-cell", "targets": [0,1,2,3,4,5]}
            ],
            "order": [3, "desc"]
        });


        $("#example tbody").on('click','.btn-detail',function(){
            var orderId = $(this).data('id');
            $.sidepanel({
                width: 700,
                title: '入住详情',
                tpl: 'checkin-detail-tpl',
                dataSource: 'order/checkin_detail',
                data: {
                    orderId: orderId
                },
                callback: function () {

                }

            });

        });


        $('#example tbody').css({cursor: 'pointer'}).on('click', '.clicked-cell', function () {
            var orderId = $(this).parents('tr').data('id');
            $.sidepanel({
                width: 700,
                title: '入住详情',
                tpl: 'checkin-detail-tpl',
                dataSource: 'order/checkin_detail',
                data: {
                    orderId: orderId
                },
                callback: function () {

                }

            });

        });


    });
</script>

</body>
</html>
