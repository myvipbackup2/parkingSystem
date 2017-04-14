<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'meta.php'; ?>

    <title>悦居后台管理系统 - 套餐类型管理</title>

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
                套餐管理
            </h3>
            <ul class="breadcrumb">
                <li>
                    <a href="#">首页</a>
                </li>
                <li>
                    <a href="#">房源管理</a>
                </li>
                <li class="active"> 套餐管理</li>
            </ul>
        </div>
        <!-- page heading end-->

        <!--body wrapper start-->
        <div class="wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel">
                        <header class="panel-heading">
                            套餐数据列表
                            <span class="tools pull-right">
                                <a href="javascript:;" class="fa fa-chevron-down"></a>
                             </span>
                        </header>
                        <div class="panel-body">
                            <div class="btn-group">
<!--                                <button id="btn-new" class="btn btn-primary" type="button">添加 <i-->
<!--                                        class="fa fa-plus"></i>-->
<!--                                </button>-->
                                <button id="btn-del" class="btn btn-primary" type="button">删除 <i
                                        class="fa fa-minus"></i>
                                </button>
                            </div>
                            <div class="adv-table">
                                <table id="example" class="table table-striped table-bordered" cellspacing="0"
                                       width="100%">
                                    <thead>
                                    <tr>
                                        <th><input type="checkbox" id="check-all"></th>
                                        <th>ID</th>
                                        <th>套餐名称</th>
                                        <th>房源</th>
                                        <th>单价</th>
                                        <th>起订天数</th>
                                        <th>套餐类型</th>
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
<script id="edit-combo-tpl" type="text/html">
    <?php include 'tpls/edit_combo_tpl.html'; ?>
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
<!--pickers plugins-->
<script type="text/javascript" src="js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="js/template.js"></script>
<script src="js/jquery.sidepanel.js"></script>

<!--common scripts for all pages-->
<script src="js/scripts.js"></script>
<script>

    $(function(){
        //查询列表
       var table = $('#example').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "combo/combo_mgr",
            "columns": [
                {
                    "data": null, "orderable": false, width: "16px", "render": function (data, type, row) {
                    return '<input type="checkbox" value="' + row.combo_id + '" class="combo-type-check"/>'
                    }
                },
                {"data": "combo_id"},
                {"data": "title"},
                {"data": "house_title"},
                {"data": "price"},
                {"data": "days"},
                {"data": "type_name"},
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return '<a href="javascript:;" class="btn-edit">编辑 <i class="fa fa-edit"></i></a> | <a href="javascript:;" class="btn-del" data-id="' + row.combo_id + '">删除 <i class="fa fa-times"></i></a>';
                    },
                }
            ],
            "columnDefs": [
                {"orderable": false, "targets": [0,6,7]},
                {"className": "clicked-cell", "targets": [1,2,3,4,5,6]}
            ],
            "order": [1, "desc"]
        });
        //删除套餐类型
        $('#example tbody').on('click', '.btn-del', function () {
            if (confirm('是否删除该记录，删除后可以在回收站恢复!')) {
                var dataId = $(this).data('id');
                $.get('combo/combo_del', {combo_id: dataId}, function (data) {
                    if (data == 'success') {
                        table.ajax.reload(null, true);//重新加载数据
                        $.gritter.add({
                            title: '信息提示!',
                            text: '记录删除成功!'
                        });
                    }
                }, 'text');
            }
            return false;
        });

        /*****点击编辑按钮*****/
        $('#example tbody').on('click', '.btn-edit', function () {

            var dataId = $(this).parents('tr').data('id');

            $.sidepanel({
                width: 800,
                title: '编辑套餐',
                tpl: 'edit-combo-tpl',
                dataSource: 'combo/combo_detail',
                data: {
                    comboId: dataId
                },
                callback: function () {
                    $(".combo-time").datepicker({
                        format: 'yyyy-mm-dd'
                    });

                }
            });
        });


        $('.check-all').click(function () {
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

        //全选checkbox
        var $rowsCheckbox;
        $("#check-all").on("click", function () {
            $rowsCheckbox = $("#example .combo-type-check");
            if (this.checked) {
                $rowsCheckbox.attr("checked", true);
            } else {
                $rowsCheckbox.attr("checked", false);
            }
        });

        //全部删除
        $("#btn-del").on("click", function () {
            if (confirm('是否删除记录，删除后可以在回收站恢复!')) {
                $rowsCheckbox = $("#example .combo-type-check");
                var ids = "";
                $rowsCheckbox.each(function (index, elem) {
                    if (this.checked) {
                        ids += this.value + ",";
                    }
                });
                $.get('combo/combo_del_all', {ids: ids}, function (data) {
                    if (data == 'success') {
                        table.ajax.reload(null, true);//重新加载数据
                        $.gritter.add({
                            title: '信息提示!',
                            text: '记录删除成功!'
                        });
                    }
                }, 'text');
            }
        });

    });

</script>

</body>
</html>
