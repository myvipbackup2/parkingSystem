<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'meta.php'; ?>

    <title>悦居后台管理系统 - 小区管理</title>

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
    <!-- /*<style>
        .adv-table.editable-plot{
            width:30%;
            float:left;
        }
        .adv-table.search-plot{
            width:60%;
            float:right;
        }
        .pagelist{
            width:40%;
            float:right;
        }
        /*.page-ul-list{
            width:300px;
            list-style: none;
            float:left;
        }*/
        /*.page-ul-list li{
            float: left;
        }*/
    </style>*/ -->

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
                小区管理
            </h3>
            <ul class="breadcrumb">
                <li>
                    <a href="#">首页</a>
                </li>
                <li>
                    <a href="<?php echo site_url('plot') ?>">小区管理</a>
                </li>
                <li class="active"> 小区管理</li>
            </ul>
        </div>
        <!-- page heading end-->

        <!--body wrapper start-->
        <div class="wrapper">

            <div class="row">
                <div class="col-sm-12">
                    <section class="panel">
                        <header class="panel-heading custom-tab">
                            <!--                            房源数据列表-->
                            <ul class="nav nav-tabs " id="my-tabs">
                                <li class="active">
                                    <a href="#all-plots" data-toggle="tab" class="all-plot">全部小区</a>
                                </li>
                                <li class=""> <a href="#recycle" data-toggle="tab" class="recycle">回收站</a></li>
                            </ul>
                            <span class="tools pull-right">
                                <a href="javascript:;" class="fa fa-chevron-down"></a>
                             </span>
                        </header>

                        <div class="panel-body">
                            <div class="tab-content" id="my-tab-pane">
                                <div class="tab-pane active" id="all-plots">
                                    <div class="adv-table editable-plot">
                                        <div class="clearfix">
                                            <div class="btn-group">
                                                <button id="editable-sample_new" class="btn btn-primary">
                                                    添加 <i class="fa fa-plus"></i>
                                                </button>
                                                <button id="message-dele" class="btn btn-primary">删除 <i class="fa fa-minus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="adv-table">
                                <table id="example" class="display table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th><input type="checkbox" class="check-all"/></th>
                                        <th>编号</th>
                                        <th>小区名称</th>
                                        <th>开发商名称</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>

                                </table>

                            </div>
                                </div>
                                <div class="tab-pane" id="recycle">
<!--                                    <button id="btn-recover" class="btn btn-primary" type="button">恢复 <i-->
<!--                                            class="fa fa-mail-reply-all"></i>-->
<!--                                    </button>-->
                                    <div class="adv-table">
                                        <table id="recycle-table" class="table table-striped table-bordered"
                                               cellspacing="0"
                                               width="100%">
                                            <thead>
                                            <tr>
                                                <th><input type="checkbox" class="check-all"/></th>
                                                <th>编号</th>
                                                <th>小区名称</th>
                                                <th>开发商名称</th>
                                                <th>操作</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
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
<script id="new-user-tpl" type="text/html">

    <?php include 'tpls/new_plot_tpl.html' ?>
</script>
<script id="edit-plot-tpl" type="text/html">
    <?php include 'tpls/edit_plot_tpl.html'; ?>
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

<!-- ueditor 配置文件 -->
<script src="js/ueditor/ueditor.config.js"></script>
<!-- ueditor 编辑器源码文件 -->
<script src="js/ueditor/ueditor.all.min.js"></script>

<script src="js/template.js"></script>
<script src="js/jquery.sidepanel.js"></script>
<script src="js/plupload.full.min.js"></script>

<!--common scripts for all pages-->
<script src="js/scripts.js"></script>
<script>
    $(function () {
//        console.log('console');
        $('.check-all').click(function () {
            //alert('123');

            //this.checked=!this.checked;
            var blogs = $('.select_check');
            if (this.checked == true) {

                for (var i = 0; i < blogs.length; i++) {
                    blogs[i].checked = true;
                }
            } else {
                for (var i = 0; i < blogs.length; i++) {
                    blogs[i].checked = false;
                }
            }
        });
        $(' a.all-plot').click(function (e) {
            console.log(1234586);
            table.ajax.reload();//切换标签时重新加载数据
        });

        $('#message-dele').click(function () {
            //alert(123);
            var blogs = $('.select_check');
            //console.log(123);
            //var arr=[];
            var blogobj = [];
            for (var i = 0; i < blogs.length; i++) {
                if (blogs[i].checked == true) {
                    blogobj.push(blogs[i].value);
                }
            }
            if(blogobj.length == 0){
                $.gritter.add({
                    title: '信息提示!',
                    text: '请选择至少一条记录!'
                });
            }else{
                $.post('plot/del_all', {'name': blogobj}, function (data) {
                    if (data == 'success') {
                        //location.href="plot/index";
                        //console.log(123);
                        table.ajax.reload(null, true);//重新加载数据
                        $.gritter.add({
                            title: '信息提示!',
                            text: '记录删除成功!'
                        });
                    }
                }, 'text');
            }

        });

        $('#my-tabs a.recycle').on('click',function (e) {
            var table = $('#recycle-table').DataTable({
                "processing": true,
                "serverSide": true,
                "retrieve": true,
                "ajax": "plot/get_del_plot",
                "columns": [
                    {
                        "width": "16px",
                        "data": null,
                        "render": function (data, type, row) {
                            return '<input type="checkbox" name="del[]" class="select_check" value="' + row.plot_id + '">';
                        },
                    },
                    {"data": "plot_id", "width": "30px", "className": "text-center"},
                    {"data": "plot_name"},
                    {"data": "developer_name"},
                    {
                        "targets": -1,
                        "data": null,
                        "render": function (data, type, row) {
                            return '<a href="javascript:;" class="btn-recover" data-id="' + row.plot_id + '">恢复 <i class="fa fa-mail-reply"></i></a>';
                        }
                    }
                ],
                "columnDefs": [
                    {
                        "orderable": false,
                        "targets": [0,3]
                    },

                ],
                "order": [1, 'asc']
            });

            table.ajax.reload();
            $(this).tab('show');
            e.preventDefault();
        });
        $('#example tbody').on('click', '.btn-del', function () {
            if (confirm('是否删除该记录，删除后可以在回收站恢复!')) {
                var dataId = $(this).data('id');
                $.get('plot/plot_del', {plotId: dataId}, function (data) {
                    if (data == 'success') {
                        table.ajax.reload(null, false);//重新加载数据
                        $.gritter.add({
                            title: '信息提示!',
                            text: '记录删除成功!'
                        });
                    }
                }, 'text');
            }
            return false;
        });
        
        var table = $('#example').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "plot/plot_mgr",
            "columns": [
                {
                    "width": "16px",
                    "data": null,
                    "render": function (data, type, row) {
                        return '<input type="checkbox" name="del[]" class="select_check" value="' + row.plot_id + '">';
                    },
                },
                {"data": "plot_id", "width": "30px", "className": "text-center"},
                {"data": "plot_name"},
                {"data": "developer_name"},
                {
                    "targets": -1,
                    "data": null,
                    "render": function (data, type, row) {
                        return '<a href="javascript:;" class="btn-edit" data-id="' + row.plot_id + '">编辑 <i class="fa fa-edit"></i></a> | <a href="javascript:;" class="btn-del" data-id="' + row.plot_id + '">删除 <i class="fa fa-times"></i></a>';
                    },
                }
            ],
            "columnDefs": [
                {
                    "orderable": false,
                    "targets": [0]
                },

            ],
            "order": [1, 'asc']
        });
        console.log('.btn-recover');
        $('#recycle-table tbody').on('click', '.btn-recover', function () {
            var dataId = $(this).attr('data-id');
            console.log(123456);
            var edit_index=$(this).parent().parent().index();
            $.get('plot/plot_recover',{'plot_id':dataId}, function () {
                $('#recycle-table tbody tr').eq(edit_index).remove();
            });
        });
        /* 编辑小区*/
        $('#example tbody').on('click', '.btn-edit', function () {
            var dataId = $(this).attr('data-id');
            console.log('saas');
            $.sidepanel({
                width: 800,
                title: '编辑小区',
                tpl: 'edit-plot-tpl',
                dataSource: 'plot/get_plot_by_id',
                data: {
                    plotId: dataId
                },
                callback: function () {//sidepanel显示后的后续操作，主要是针对sidepanel中的元素的dom操作



                }
            });
        });

        $('#editable-sample_new').on('click', function () {
            $.sidepanel({
                width: 700,
                title: '添加新小区',

                tpl: 'new-user-tpl',
                dataSource: 'plot/get_developer',

                callback: function () {

                    //实例化编辑器
                    UE.delEditor('plot-description');
                    plot_ue = UE.getEditor('plot-description');
                }
            });
        });

//        $('#data-table tbody tr').css({cursor: 'pointer'})
//            .on('click', function () {
//                var dataId = $(this).data('id');
//
//                $.sidepanel({
//                    width: 700,
//                    title: '用户详情',
//                    tpl: 'user-tpl',
//                    dataSource: 'user/user_detail',
//                    data: {
//                        userId: dataId
//                    },
//                    callback: function () {//sidepanel显示后的后续操作，主要是针对sidepanel中的元素的dom操作
//                        $('#myTabs a').click(function (e) {
//                            //数据需要ajax操作，可以直接在这里$.get(...);
//
//                            $(this).tab('show');
//                            e.preventDefault();
//                        });
//                    }
//                });
//            });


    });
</script>

</body>
</html>
