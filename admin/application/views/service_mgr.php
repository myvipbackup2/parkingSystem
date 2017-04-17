<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'meta.php'; ?>

    <title>悦居后台管理系统 - 维修记录</title>

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
        .adv-table.editable-facility{
            width:30%;
            float:left;
        }
        .adv-table.search-facility{
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
                设备管理
            </h3>
            <ul class="breadcrumb">
                <li>
                    <a href="#">首页</a>
                </li>
                <li>
                    <a href="<?php echo site_url('facility') ?>">设备管理</a>
                </li>
                <li class="active"> 维修记录</li>
            </ul>
        </div>
        <!-- page heading end-->

        <!--body wrapper start-->
        <div class="wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel">
                        <header class="panel-heading">
                            维修记录
                            <span class="tools pull-right">
                                <a href="javascript:;" class="fa fa-chevron-down"></a>
                             </span>
                        </header>
                        <div class="panel-body">
                            <div class="adv-table editable-facility">
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
                                <table id="example" class="display table table-bordered table-striped" id="data-table">
                                    <thead>
                                    <tr>
                                        <th><input type="checkbox" class="check-all"/></th>
                                        <th>编号<t/h>
                                        <th>小区</th>
                                        <th>房源</th>
                                        <th>设备</th>
                                        <th>问题</th>
                                        <th>时间</th>
                                        <th>删除</th>
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
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal-plot1"
     class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close close-plot" type="button">×</button>
                <h4 class="modal-title">选择小区</h4>
            </div>
            <div class="modal-body">
                <div style='background: #2e3644;text-align: center;margin-bottom: 10px;height: 40px;'><h3
                            style='line-height: 40px;margin: 0 auto;color: white;'>小区搜索</h3></div>
                <form class='form-horizontal' role='form'>
                    <div class='form-group'>
                        <div class='col-lg-9' style='margin-left:10px'>
                            <input type='text' class='form-control plot-street' placeholder='小区'>
                        </div>
                        <div class='col-lg-2'>
                            <input type='button' class='btn btn-default btn-search-plot' value='搜索'>
                        </div>
                    </div>
                </form>
                <table style='margin-left:10px' class='plot-table'>
                </table>
            </div>
        </div>
    </div>
</div>
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal-plot2"
     class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close close-plot" type="button">×</button>
                <h4 class="modal-title">选择房源</h4>
            </div>
            <div class="modal-body">
                <div style='background: #2e3644;text-align: center;margin-bottom: 10px;height: 40px;'><h3
                            style='line-height: 40px;margin: 0 auto;color: white;'>房源搜索</h3></div>
                <form class='form-horizontal' role='form'>
                    <div class='form-group'>
                        <div class='col-lg-9' style='margin-left:10px'>
                            <input type='text' class='form-control house-street' placeholder='房源'>
                        </div>
                        <div class='col-lg-2'>
                            <input type='button' class='btn btn-default btn-search-house' value='搜索'>
                        </div>
                    </div>
                </form>
                <table style='margin-left:10px' class='house-table'>
                </table>
            </div>
        </div>
    </div>
</div>
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal-plot3"
     class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close close-plot" type="button">×</button>
                <h4 class="modal-title">选择设备</h4>
            </div>
            <div class="modal-body">
                <div style='background: #2e3644;text-align: center;margin-bottom: 10px;height: 40px;'><h3
                            style='line-height: 40px;margin: 0 auto;color: white;'>设备搜索</h3></div>
                <form class='form-horizontal' role='form'>
                    <div class='form-group'>
                        <div class='col-lg-9' style='margin-left:10px'>
                            <input type='text' class='form-control facility-street' placeholder='房源'>
                        </div>
                        <div class='col-lg-2'>
                            <input type='button' class='btn btn-default btn-search-facility' value='搜索'>
                        </div>
                    </div>
                </form>
                <table style='margin-left:10px' class='facility-table'>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- templates -->
<script id="new-user-tpl" type="text/html">

    <?php include 'tpls/new_service_tpl.html' ?>
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
<script src="js/plupload.full.min.js"></script>

<!-- ueditor 配置文件 -->
<script src="js/ueditor/ueditor.config.js"></script>
<!-- ueditor 编辑器源码文件 -->
<script src="js/ueditor/ueditor.all.min.js"></script>

<!--common scripts for all pages-->
<script src="js/scripts.js"></script>
<script>
    $(function () {
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


        $('#message-dele').click(function () {
            //alert(123);
            var blogs = $('.select_check');
            //console.log(123);
            //var arr=[];
            var blogobj = {};
            for (var i = 0; i < blogs.length; i++) {
                //console.log(blogs[i].value);
                if (blogs[i].checked == true) {
                    blogobj[i] = blogs[i].value;
                }
            }

            $.post('service/del_all', {'name': blogobj}, function (data) {
                if (data == 'success') {
                    //location.href="facility/index";
                    //console.log(123);
                    table.ajax.reload(null, true);//重新加载数据
                    $.gritter.add({
                        title: '信息提示!',
                        text: '记录删除成功!'
                    });
                }
            }, 'text');

            //console.log(blogobj);

        });

        $('#example tbody').on('click', '.btn-del', function () {
            if (confirm('是否删除该记录，删除后可以在回收站恢复!')) {
                var dataId = $(this).data('id');
                //alert(dataId);
                $.get('service/facility_del', {facilityId: dataId}, function (data) {
                    if (data == 'success') {
                        //alert('删除成功');
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
            "ajax": "service/service_mgr",
            "columns": [
                {
                    "width": "16px",
                    "data": null,
                    "render": function (data, type, row) {
                        return '<input type="checkbox" name="del[]" class="select_check" value="' + row.service_id + '">';
                    },
                },
                {"data": "service_id", "width": "40px", "className": "text-center"},
                {"data": "plot_name"},
                {"data":"house_name"},
                {"data":"facility_name"},
                {"data": "question_dec"},
                {"data":"service_time"},
                {
                    "width": "40px",
                    "targets": -1,
                    "data": null,
                    "render": function (data, type, row) {
                        return '<a href="javascript:;" class="btn-del" data-id="' + row.service_id + '">删除</a>';
                    },
                }
            ],
            "columnDefs": [
                {
                    "orderable": false,
                    "targets": [0,2,3,6]
                },

            ],
            "order": [1, 'asc']
        });


        $('#editable-sample_new').on('click', function () {
            $.sidepanel({
                width: 700,
                title: '添加维修记录',
                tpl: 'new-user-tpl',
                // tpl:'new-facility-tpl',
                callback: function () {

                    //选择小区

                    $(".btn-search-plot").on("click", function () {
                        $(".plot-table tr").remove();
                        var street = $(".plot-street").val();
                        $.get("service/order_search_plot",{street: street}, function (data) {
                            if (data.length >0) {
                                var str = "";
                                for (var i = 0; i < data.length; i++) {
                                    str += "<tr><td>" + data[i].plot_name + "</td><td><button class='btn btn-default choose-house' style='margin-left: 10px' data-id=" + data[i].plot_id + " data-detail=" + data[i].plot_name +  ">选择</button></td></tr>"
                                }
                                var house_table = $(str);
                                $(".plot-table").html("").append(house_table);
                                $(".choose-house").on("click", function () {
                                    $(".plot-choose-end").text($(this).attr("data-detail")).attr("data-id", $(this).attr("data-id"));
                                    $('.close-plot').trigger('click');
                                    $("#plot_name_input").val($(this).attr("data-detail"));
                                    //console.log($(".plot-choose-end").attr("data-id"));
                                    $(".plot-table").empty();
                                    $(".house-table").empty();
                                    $(".facility-table").empty();
                                    $("#house_name").text("");
                                    $("#house_name_input").val("");
                                    $("#facility_name").text("");
                                    $("#facility_name_input").val("");
                                });

                            }else{
                                var house_table = $('<p>未查到小区</p>');
                                $(".plot-table").html("").append(house_table);
                            }
                        }, "json");
                    });

                    $(".btn-search-house").on("click", function () {
                        $(".house-table tr").remove();
                        var street = $(".house-street").val();
                        var plot_id=$(".plot-choose-end").attr("data-id");
                        // console.log(plot_id);
                        $.get("service/order_search_house",{street: street,plot_id:plot_id}, function (data) {
                            if (data.length >0) {
                                var str = "";
                                for (var i = 0; i < data.length; i++) {
                                    str += "<tr><td>" +data[i].title + "."+data[i].street + "." + data[i].region + "</td><td>" + data[i].price + "</td><td><button class='btn btn-default choose-house' style='margin-left: 10px' data-id=" + data[i].house_id + " data-detail=" + data[i].title + "--" + data[i].street + '.' + data[i].region + '--' + data[i].price + ">选择</button></td></tr>"
                                }
                                var house_table = $(str);
                                $(".house-table").html("").append(house_table);
                                $(".choose-house").on("click", function () {
                                    $(".house-choose-end").text($(this).attr("data-detail")).attr("data-id", $(this).attr("data-id"));
                                    $('.close-plot').trigger('click');
                                    $("#house_name_input").val($(this).attr("data-detail"));
                                    $(".plot-table").empty();
                                    $(".house-table").empty();
                                    $(".facility-table").empty();
                                    $("#facility_name").text("");
                                    $("#facility_name_input").val("");
                                });
                            }else{
                                var house_table = $('<p>未查到房源</p>');
                                $(".house-table").html("").append(house_table);
                            }
                        }, "json")
                    });
                    $(".btn-search-facility").on("click", function () {
                        $(".house-table tr").remove();
                        var street = $(".facility-street").val();
                        var house_id=$(".house-choose-end").attr("data-id");
                        // console.log(plot_id);
                        $.get("service/order_search_facility",{street: street,house_id:house_id}, function (data) {
                            if (data.length >0) {
                                var str = "";
                                for (var i = 0; i < data.length; i++) {
                                    str += "<tr><td>" + data[i].name + "</td><td><button class='btn btn-default choose-house' style='margin-left: 10px' data-id=" + data[i].house_id + " data-detail=" + data[i].name + ">选择</button></td></tr>"
                                }
                                var house_table = $(str);
                                $(".facility-table").html("").append(house_table);
                                $(".choose-house").on("click", function () {
                                    $(".facility-choose-end").text($(this).attr("data-detail")).attr("data-id", $(this).attr("data-id"));
                                    $('.close-plot').trigger('click');
                                    $("#facility_name_input").val($(this).attr("data-detail"));
                                    $(".house-table").empty();
                                    $(".plot-table").empty();
                                    $(".facility-table").empty();
                                });
                            }else{
                                var house_table = $('<p>未查到设备</p>');
                                $(".facility-table").html("").append(house_table);
                            }
                        }, "json")
                    });

                    //实例化编辑器
                    UE.delEditor('new-container');
                    var ue = UE.getEditor('new-container');


                }
            });
        });

        $('#data-table tbody tr').css({cursor: 'pointer'})
            .on('click', function () {
                var dataId = $(this).data('id');

                $.sidepanel({
                    width: 700,
                    title: '用户详情',
                    tpl: 'user-tpl',
                    // tpl:'facility-tpl'
                    dataSource: 'user/user_detail',
                    data: {
                        userId: dataId
                    },
                    callback: function () {//sidepanel显示后的后续操作，主要是针对sidepanel中的元素的dom操作
                        $('#myTabs a').click(function (e) {
                            //数据需要ajax操作，可以直接在这里$.get(...);

                            $(this).tab('show');
                            e.preventDefault();
                        });
                    }
                });
            });


    });
</script>

</body>
</html>
