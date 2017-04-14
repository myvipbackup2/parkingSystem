<!--lidongze-->
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'meta.php'; ?>

    <title>悦居后台管理系统 - 管理员管理</title>

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
                管理员管理
            </h3>
            <ul class="breadcrumb">
                <li>
                    <a href="#">首页</a>
                </li>
                <li>
                    <a href="#">系统管理</a>
                </li>
                <li class="active"> 管理员管理</li>
            </ul>
        </div>
        <!-- page heading end-->

        <!--body wrapper start-->
        <div class="wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel">
                        <header class="panel-heading">
                            管理员数据列表
                            <span class="tools pull-right">
                                <a href="javascript:;" class="fa fa-chevron-down"></a>
                             </span>
                        </header>
                        <div class="panel-body">
                            <div style="margin: 9px 0 5px;" class="btn-group">
                                <button id="btn-add" class="btn btn-primary" type="button">添加 <i class="fa fa-plus"></i>
                                </button>
                            </div>
                            <div class="adv-table">
                                <table id="example" class="table table-striped table-bordered" cellspacing="0"
                                       width="100%">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>头像</th>
                                        <th>用户名</th>
                                        <th>电话</th>
                                        <th>权限等级</th>
                                        <th>是否绑定微信</th>
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
<script id="admin-tpl" type="text/html">
    <?php include 'tpls/admin_detail_tpl.html'; ?>
</script>

<script id="add-admin-tpl" type="text/html">
    <?php include 'tpls/add_admin_tpl.html'; ?>
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

<!--gritter script-->
<script src="js/gritter/js/jquery.gritter.js"></script>

<script src="js/template.js"></script>
<script src="js/jquery.sidepanel.js"></script>


<!--common scripts for all pages-->
<script src="js/scripts.js"></script>

<script>
    $(function () {

        var table = $('#example').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "admin/admin_mgr",
            "columns": [
                {"data": "admin_id", className: "clicked-cell"},
                {
                    "data": null,
                    "className": "clicked-cell",
                    "render": function (data, type, row) {
                        return '<img style="width:40px;height:40px;" src="' + row.img_src + '" />'
                    }
                },
                {"data": "username", className: "clicked-cell"},
                {"data": "tel", className: "clicked-cell"},
                {"data": "level", className: "clicked-cell"},
                {
                    "data": null,
                    className: "clicked-cell",
                    "render": function (data, type, row) {
                        return row.open_id ? row.open_id : '未绑定';
                    }
                },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return '<a href="javascript:;" class="btn-del" data-id="' + row.admin_id + '">删除</a>';
                    }
                }
            ],
            "columnDefs": [
                {
                    "orderable": false,
                    "targets": [1, 2, 3, 4, 5, 6]
                }
            ],
            "order": [[0, 'desc']]
        });

        //全选or反选
        /*$("#check-all").on("change",function(){
         if($(this).prop("checked")==true){
         $(".delete-admin").prop("checked",true);
         }else{
         $(".delete-admin").prop("checked",false);
         }
         });*/

        //批量删除
        /*$("#btn-del").on("click",function(){
         if(confirm('是否删除该记录，删除后不可回复!')) {
         var str = "";
         $("tbody :checked").each(function () {
         str += this.value + ",";
         });
         str = str.slice(0, -1);
         console.log(str);
         $.get("manage/delete_more_admin", {admin: str}, function (data) {
         if (data == "success") {
         table.ajax.reload(null, true);//重新加载数据
         $.gritter.add({
         title: '信息提示!',
         text: '删除成功!'
         });
         } else {
         $.gritter.add({
         title: '信息提示!',
         text: '删除失败，请刷新后重试!'
         });
         }
         }, "text");
         }else{
         $("tbody :checked").prop("checked",false);
         }
         return false;
         });*/

        //单个删除
        $('#example tbody').on('click', '.btn-del', function () {
            if (confirm('是否删除该记录，删除后不可回复!')) {
                var dataId = $(this).data('id');
                $.get('admin/delete_admin', {adminId: dataId}, function (data) {
                    if (data == 'success') {
                        table.ajax.reload(null, true);//重新加载数据
                        $.gritter.add({
                            title: '信息提示!',
                            text: '删除成功!'
                        });
                    }
                }, 'text');
            }
            return false;
        });

        //管理员详情
        $('#example tbody').css({cursor: 'pointer'}).on('click', '.clicked-cell', function () {

            var dataId = $(this).parent().data('id');

            $.sidepanel({
                width: 600,
                title: '管理员详情',
                tpl: 'admin-tpl',
                dataSource: 'admin/admin_detail',
                data: {
                    adminId: dataId
                },
                callback: function () {//sidepanel显示后的后续操作，主要是针对sidepanel中的元素的dom操作
                    $(".wrapper-change").hide();
                    $(".change-admin").on("click", function () {
                        $(".wrapper-change").show();
                        $(".wrapper-detail").hide();
                    });
                    $(".change-esc").on("click", function () {
                        $(".wrapper-change").hide();
                        $(".wrapper-detail").show();
                    })
                }
            });
        });

        //添加管理员
        $("#btn-add").on("click", function () {
            $.sidepanel({
                width: 700,
                title: '添加管理员',
                tpl: 'add-admin-tpl',
                callback: function () {//sidepanel显示后的后续操作，主要是针对sidepanel中的元素的dom操作

                }
            });
        });

    });
</script>

</body>
</html>
