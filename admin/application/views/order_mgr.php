<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'meta.php'; ?>

    <title>随心停后台管理系统 - 订单管理</title>

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
    <!--pickers css-->
    <link rel="stylesheet" type="text/css" href="js/bootstrap-datepicker/css/datepicker-custom.css"/>
    <link href="js/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet"/>
    <link href="js/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet"/>

    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <style>
        .line {
            padding-top: 0;
        }
    </style>
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
                <li class="active"> 订单管理</li>
            </ul>
        </div>
        <!-- page heading end-->

        <!--body wrapper start-->
        <div class="wrapper">
            <div class="row">
                <div class="col-sm-12">

                    <section class="panel">
                        <header class="panel-heading custom-tab ">
                            <ul class="nav nav-tabs" id="my-tabs">
                                <li class="active">
                                    <a href="#all-order" data-toggle="tab" class="all-orders">全部订单</a>
                                </li>
                                <li order-status="1">
                                    <a href="#untreated" data-toggle="tab">已支付</a>
                                </li>
                                <li order-status="2">
                                    <a href="#ongoing" data-toggle="tab">停车中</a>
                                </li>
                                <li order-status="3">
                                    <a href="#completed" data-toggle="tab">已完成</a>
                                </li>
                                <li order-status="5">
                                    <a href="#recycle" data-toggle="tab" class="recycle">未支付</a>
                                </li>
                                <li order-status="6">
                                    <a href="#refund" data-toggle="tab" class="recycle">申请退款</a>
                                </li>
                            </ul>
                        </header>
                        <div class="panel-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="all-order">
                                    <div class="panel-body">
                                        <div style="margin: 9px 0 5px;" class="btn-group">
                                            <button id="btn-add" class="btn btn-primary" type="button">添加 <i
                                                        class="fa fa-plus"></i></button>
                                        </div>
                                        <div class="adv-table">
                                            <table id="example" class="table table-striped table-bordered"
                                                   cellspacing="0"
                                                   width="100%">
                                                <thead>
                                                <tr>
                                                    <th><input type="checkbox" class="check-all"/></th>
                                                    <th>编号</th>
                                                    <th>预订方式</th>
                                                    <th>停车场名称</th>
                                                    <th>用户</th>
                                                    <th>手机号</th>
                                                    <th>停车时间</th>
                                                    <th>离开时间</th>
                                                    <th>价格</th>
                                                    <th>订单状态</th>
                                                    <th>操作</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="untreated">
                                    <table id="untreated-table" class="table table-striped table-bordered"
                                           cellspacing="0"
                                           width="100%">
                                        <thead>
                                        <tr>
                                            <th><input type="checkbox" class="check-all"/></th>
                                            <th>编号</th>
                                            <th>预订方式</th>
                                            <th>停车场名称</th>
                                            <th>用户</th>
                                            <th>手机号</th>
                                            <th>停车时间</th>
                                            <th>离开时间</th>
                                            <th>价格</th>
                                            <th>订单状态</th>
                                            <th>操作</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane" id="ongoing">
                                    <table id="ongoing-table" class="table table-striped table-bordered"
                                           cellspacing="0"
                                           width="100%">
                                        <thead>
                                        <tr>
                                            <th><input type="checkbox" class="check-all"/></th>
                                            <th>编号</th>
                                            <th>预订方式</th>
                                            <th>停车场名称</th>
                                            <th>用户</th>
                                            <th>手机号</th>
                                            <th>停车时间</th>
                                            <th>离开时间</th>
                                            <th>价格</th>
                                            <th>订单状态</th>
                                            <th>操作</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane" id="completed">
                                    <table id="completed-table" class="table table-striped table-bordered"
                                           cellspacing="0"
                                           width="100%">
                                        <thead>
                                        <tr>
                                            <th><input type="checkbox" class="check-all"/></th>
                                            <th>编号</th>
                                            <th>预订方式</th>
                                            <th>停车场名称</th>
                                            <th>用户</th>
                                            <th>手机号</th>
                                            <th>停车时间</th>
                                            <th>离开时间</th>
                                            <th>价格</th>
                                            <th>订单状态</th>
                                            <th>操作</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane" id="cancelled">

                                    <table id="cancelled-table" class="table table-striped table-bordered"
                                           cellspacing="0"
                                           width="100%">
                                        <thead>
                                        <tr>
                                            <th><input type="checkbox" class="check-all"/></th>
                                            <th>编号</th>
                                            <th>预订方式</th>
                                            <th>停车场名称</th>
                                            <th>用户</th>
                                            <th>手机号</th>
                                            <th>停车时间</th>
                                            <th>离开时间</th>
                                            <th>价格</th>
                                            <th>订单状态</th>
                                            <th>操作</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane" id="recycle">

                                    <table id="recycle-table" class="table table-striped table-bordered"
                                           cellspacing="0"
                                           width="100%">
                                        <thead>
                                        <tr>
                                            <th><input type="checkbox" class="check-all"/></th>
                                            <th>编号</th>
                                            <th>预订方式</th>
                                            <th>停车场名称</th>
                                            <th>用户</th>
                                            <th>手机号</th>
                                            <th>停车时间</th>
                                            <th>离开时间</th>
                                            <th>价格</th>
                                            <th>订单状态</th>
                                            <th>操作</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="tab-pane" id="refund">

                                    <table id="refund-table" class="table table-striped table-bordered"
                                           cellspacing="0"
                                           width="100%">
                                        <thead>
                                        <tr>
                                            <th><input type="checkbox" class="check-all"/></th>
                                            <th>编号</th>
                                            <th>预订方式</th>
                                            <th>停车场名称</th>
                                            <th>用户</th>
                                            <th>手机号</th>
                                            <th>停车时间</th>
                                            <th>离开时间</th>
                                            <th>价格</th>
                                            <th>订单状态</th>
                                            <th>操作</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
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
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal-plot" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close close-plot" type="button">×</button>
                <h4 class="modal-title">添加用户</h4>
            </div>
            <div class="modal-body">
                <form role="form">
                    <div class="form-group clearfix">
                        <label for="facility-name" class="col-lg-3 col-sm-3 control-label">手机号搜索</label>
                        <div class="col-lg-7">
                            <input type="text" id="plot-name" name="title" class="form-control" placeholder="请输入手机号"
                                   required>
                        </div>
                        <div class="col-lg-2">
                            <button type="button" class="btn btn-primary" id="usersearch">搜索</button>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <table class="user-table" style='margin-left:10px; text-align:center;'>

                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal-plot1"
     class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close close-plot" type="button">×</button>
                <h4 class="modal-title">注册新用户</h4>
            </div>
            <div class="modal-body">
                <form class='form-horizontal' role='form'>
                    <div class='form-group'>
                        <label class='col-lg-3 col-sm-3 control-label'>用户名</label>
                        <div class='col-lg-8'>
                            <input type='text' class='form-control new-name' placeholder='登陆id'>
                            <p class='help-block name-help' style='display: none;'></p>
                        </div>
                    </div>
                    <div class='form-group'>
                        <label class='col-lg-3 col-sm-3 control-label'>密码</label>
                        <div class='col-lg-8'>
                            <input type='password' class='form-control new-pwd' placeholder='密码'>
                        </div>
                    </div>
                    <div class='form-group'>
                        <label class='col-lg-3 col-sm-3 control-label'>确认密码</label>
                        <div class='col-lg-8'>
                            <input type='password' class='form-control new-pwd2' placeholder='再次输入密码'>
                            <p class='help-block pwd-help' style='display: none;'>两次密码不相同</p>
                        </div>
                    </div>
                    <div class='form-group'>
                        <label class='col-lg-3 col-sm-3 control-label'>联系方式</label>
                        <div class='col-lg-8'>
                            <input type='password' class='form-control new-phone' placeholder='联系方式'>
                        </div>
                    </div>
                    <div class='form-group'>
                        <label class='col-lg-3 col-sm-3 control-label'></label>
                        <div class='col-lg-8 '>
                            <input type='button' class='btn btn-primary add-new-user' value='添加'>
                        </div>
                    </div>
                </form>
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
                <h4 class="modal-title">选择停车场</h4>
            </div>
            <div class="modal-body">
                <div style='background: #2e3644;text-align: center;margin-bottom: 10px;height: 40px;'><h3
                            style='line-height: 40px;margin: 0 auto;color: white;'>停车场搜索</h3></div>
                <form class='form-horizontal' role='form'>
                    <div class='form-group'>
                        <div class='col-lg-9' style='margin-left:10px'>
                            <input type='text' class='form-control park-street' placeholder='街道'>
                        </div>
                        <div class='col-lg-2'>
                            <input type='button' class='btn btn-default btn-search-park' value='搜索'>
                        </div>
                    </div>
                </form>
                <table style='margin-left:10px' class='park-table'>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- templates -->
<script id="order_detail-tpl" type="text/html">
    <?php include 'tpls/order_detail_tpl.html'; ?>
</script>
<!--订单添加-->
<script id="order-add-tpl" type="text/html">
    <?php include 'tpls/order_add_tpl.html'; ?>
</script>
<!--结账-->
<script id="order-end-tpl" type="text/html">
    <?php include 'tpls/order_end_tpl.html'; ?>
</script>
<!--停车-->
<script id="order-check-in-tpl" type="text/html">
    <?php include 'tpls/order_check_in_tpl.html'; ?>
</script>
<!--取消订单-->
<script id="order-cancel-tpl" type="text/html">
    <?php include 'tpls/order_cancel_tpl.html'; ?>
</script>
<!--续租-->
<script id="order-keep-tpl" type="text/html">
    <?php include 'tpls/order_keep_tpl.html'; ?>
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
<script src="js/bootstrap-daterangepicker/moment.min.js"></script>
<script src="js/bootstrap-daterangepicker/daterangepicker.js"></script>

<script src="js/my97DatePicker/WdatePicker.js"></script>

<!--common scripts for all pages-->
<script src="js/scripts.js"></script>

<!--pickers plugins-->
<script type="text/javascript" src="js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<script>
    $(function () {

        $('#my-tabs a:not(".all-orders")').click(function (e) {
            //数据需要ajax操作，可以直接在这里$.get(...);
            var recover = '',
                untreated = "",
                underway = "",
                done = "",
                orderCancel = "",
                refund = "";
            var orderStatus = this.innerText;
            var selector = $(this.hash + '-table');
            console.log(selector);
            var datatable = $(this.hash + '-table').DataTable({
                "processing": true,
                "serverSide": true,
                "retrieve": true,
                "ajax": {
                    "url": "order/order_mgr",
                    "data": function (d) {
                        d.status = orderStatus;
                        //添加额外的参数传给服务器
                        var val = selector.children('.reportrange span').html();
                        if (val) {
                            d.extra_search = val;
                        } else {
                            var date = moment().subtract('days', 29).format('YYYY-MM-DD') + ',' + moment().format('YYYY-MM-DD');
                            selector.children('.reportrange span').html(date);
                            d.extra_search = date;
                        }
                    }
                },
                "columns": [
                    null,
                    {"data": "order_no"},
                    {"data": "order_type"},
                    {"data": "title"},
                    {"data": "username"},
                    {"data": "tel"},
                    {"data": "start_time"},
                    {"data": "end_time"},
                    {"data": "price"},
                    {"data": "status"},
                    {
                        "data": null,
                        "width": '80px',
                        "render": function (data, type, row) {
                            if (orderStatus == '停车中') {
                                underway = '<a href="javascript:;" class="btn-keep" data-id="' + row.order_id + '">续租</a> | <a href="javascript:;" class="btn-end" data-id="' + row.order_id + '">离开</a> ';
                            }
                            if (orderStatus == '已完成') {
                                done = '<a href="javascript:;" class="btn-keep" data-id="' + row.order_id + '">续租</a>';
                            }
                            if (orderStatus == '已支付') {
                                orderCancel = '<a href="javascript:;" class="btn-start" data-id="' + row.order_id + '">停车</a> | <a href="javascript:;" class="btn-cancel" data-id="' + row.order_id + '">取消订单</a>';
                            }
                            if (orderStatus == '申请退款') {
                                if (row.cash_pledge_pay_way == '支付宝') {
                                    refund = '<a href="alipay/index?id=' + row.order_no + '" class="btn-start" data-id="' + row.order_no + '">退款</a>'
                                } else if (row.cash_pledge_pay_way == '微信') {
//                                    refund = '<a href="wechat/refund?id='+row.order_no+'" data-id="' + row.cash_pledge_pay_way + '">退款</a>'//控制器待定
                                    refund = '<a href="javascript:;" class="return_pay" data-id="' + row.order_no + '">退款</a>'
                                }
                            }
                            return untreated + underway + done + recover + orderCancel + refund;
                        }
                    }
                ],
                "columnDefs": [
                    {
                        "orderable": false,
                        "targets": 0,
                        "render": function (data, type, row) {
                            return '<input type="checkbox" name="del[]" class="select_check" value="' + row.order_id + '">';
                        }
                    },
                    {"orderable": false, "targets": [2, 3, 4, 5,10]},
                    {"className": "show-order-detail", "targets": [1, 2, 3, 4, 5, 6, 7, 8, 9]}

                ],

                "order": [[1, 'desc']]
//                initComplete: initComplete

            });
            datatable.ajax.reload();//重新加载数据，防止在操作过程中数据库中的记录发生变化
            $(this).tab('show');
            $(this.hash + '-table' + ' tbody').on('click', '.btn-recover', function () {
                if (confirm('是否恢复该记录？')) {
                    var dataId = $(this).data('id');
                    console.log(dataId);
                    $.get('order/order_recover', {orderId: dataId}, function (data) {
                        if (data == 'success') {
                            datatable.ajax.reload(null, true);//重新加载数据
                            $.gritter.add({
                                title: '信息提示!',
                                text: '记录恢复成功!'
                            });
                        }
                    }, 'text');
                }
                return false;
            });


            $(this.hash + '-table' + ' tbody').on('click', '.return_pay', function () {
                var orderno = $(this).data('id');
                var self = $(this);
                $.get('wechat/refund', {
                    id: orderno,
                }, function (data) {
                    if (data == 'success') {
                        $.gritter.add({
                            title: '信息提示!',
                            text: '退款成功!'
                        });
                        self.parent().html('退款成功');
                    } else {
                        $.gritter.add({
                            title: '信息提示!',
                            text: '退款失败!'
                        });
                    }
                }, 'text');


            });
            //结账
            $(this.hash + '-table' + ' tbody').on('click', '.btn-end', function () {
                var orderId = $(this).data('id');
                $.sidepanel({
                    width: 700,
                    title: '离开',
                    tpl: 'order-end-tpl',
                    dataSource: "order/order_end",
                    data: {
                        orderId: orderId
                    },
                    callback: function () {
                        //处理发票多选框
                        $('#is-invoice').on('change', function () {
                            var $checked = $(this).prop('checked');
                            var $formGroup = $(this).parents('div.form-group').nextAll('div.show-invoice');
                            if ($checked) {
                                $formGroup.show();
                            } else {
                                $formGroup.hide();
                            }
                        });

                        $('.btn-end-confirm').on('click', function () {
                            var order_end_id = $('#order_end_id').val();
                            var name = $('#name').val();
                            var park_exam = $('input[name=park_exam]:checked').val();
                            var money = $(".money").val();
                            var return_way = $('input[name=return_way]:checked').val();
                            var checkout_mark = $('.checkout_mark').val();
                            var is_invoice = $('#is-invoice').val();
                            var invoice_title = $('#invoice_title').val();
//                            var invoice_no = $('#invoice_no').val();
                            var invoice_address = $('#invoice_address').val();
                            var invoice_tel = $('#invoice_tel').val();
                            $.get('order/order_end_info', {
                                orderId: order_end_id,
                                name: name,
                                park_exam: park_exam,
                                money: money,
                                return_way: return_way,
                                checkout_mark: checkout_mark,
                                is_invoice: is_invoice,
                                invoice_title: invoice_title,
                                invoice_address: invoice_address,
                                invoice_tel: invoice_tel
                            }, function (data) {
                                if (data == 'success') {
                                    $.gritter.add({
                                        title: '信息提示!',
                                        text: '离开成功!'
                                    });
                                    $('.panel-close').trigger('click');
                                } else {
                                    $.gritter.add({
                                        title: '信息提示!',
                                        text: '离开失败!'
                                    });
                                }
                            }, 'text');
                        });

                    }

                });
                return false;
            });

            //停车
            $(this.hash + '-table' + ' tbody').on('click', '.btn-start', function () {
                var orderId = $(this).data('id');
                $.sidepanel({
                    width: 700,
                    title: '停车',
                    tpl: 'order-check-in-tpl',
                    dataSource: "order/enter_manage",
                    data: {
                        orderId: orderId
                    },
                    callback: function () {
                        //dom操作页面多次添加停车人
                        var $add = $(".need-add");
                        var creatAdd = function () {
                            var $body = $('<div class="checkIn-container">' +
                                '<legend></legend>' +
                                '<div class="form-group">' +
                                '<label class="col-lg-2 col-sm-2 control-label">停车用户</label>' +
                                '<div class="col-lg-10">' +
                                '<input type="text" name="name" class="form-control name" placeholder="姓名">' +
                                '</div>' +
                                '</div>' +
                                '<div class="form-group">' +
                                '<label class="col-lg-2 col-sm-2 control-label">联系方式</label>' +
                                '<div class="col-lg-10">' +
                                '<input type="text" name="phone" class="form-control phone" placeholder="telephone ">' +
                                '</div>' +
                                '</div>' +
                                '<div class="form-group">' +
                                '<label class="col-lg-2 col-sm-2 control-label">身份证号</label>' +
                                '<div class="col-lg-10">' +
                                '<input type="text" name="card" class="form-control card" placeholder="证件号">' +
                                '</div>' +
                                '</div>' +
                                '<legend></legend>' +
                                '</div>' +
                                '</div><div class="form-group"><label class="col-lg-2 col-sm-2 control-label"></label>' +
                                '<div class="col-lg-10">' +
                                '<input type="button" name="delete" class="btn btn-primary delete" value="删除本条信息">' +
                                '</div>');
                            $body.appendTo('.checkIn-container-dad');
                            $(".delete").on("click", function () {
                                $body.remove();
                            });
                        };
                        $add.on("click", function () {
//                            $('.checkIn-container ').clone().appendTo('.checkIn-container-dad').removeClass("checkIn-container").addClass("ee");
//                            $(".checkIn-container-dad .ee:last-child input").val("");
                            creatAdd();

                        });
//                        var arrayData = [];
//                        var arr =[];
                        var arrayName = [];
                        var arrayPhone = [];
                        var arrayCard = [];
                        $("input[name=confirm_enter]").on("click", function () {
                            var id = orderId;
                            var pledge = $("input[name=pledge]").val();
                            var enter_mask = $(".mask").val();
                            var manage = $("select[name=manage]").val();
                            var pay = '';

                            $("input[name='name']").each(function () {
                                var name = $(this).val();
                                arrayName.push(name);
                            });
                            $("input[name='phone']").each(function () {
                                var phone = $(this).val();
                                arrayPhone.push(phone);
                            });
                            $("input[name='card']").each(function () {
                                var card = $(this).val();
                                arrayCard.push(card);
                            });
//                            //循环orderId插入到order_Id数组，与其余三个数组一样的长度
//                            var order_Id = [];
//                            for(var i=0;i<arrayName.length;i++){
//                                order_Id.push(id);
//                            }
//                            //利用for循环取出三个数组中对应索引的值，组成一个新的数组，与停车页面的列表对应
//                            for(var j=0;j<arrayName.length;j++){
//                                arr=[ order_Id[j],arrayName[j],arrayPhone[j],arrayCard[j]];
//                                arrayData.push(arr)
//                            }
//                            console.log(arrayData);

                            $("input[name=pay]").each(function () {
                                if (this.checked == true) {
                                    pay = $(this).val();
                                }
                            });
                            //向t_enter表添加
                            $.post("order/add_enter", {
                                order_id: id,
                                arrayName: arrayName,
                                arrayPhone: arrayPhone,
                                arrayCard: arrayCard,
                            }, function (data) {

                                if (data == 'success') {
                                    $.gritter.add({
                                        title: '信息提示!',
                                        text: '停车信息添加成功!'
                                    });
                                    $("input[name=confirm_enter]").hide();
                                }
                            }, 'text');
                            //向t_order表中修改

                            $.get("order/manage_enter", {
                                id: id,
                                pledge: pledge,
                                enter_mask: enter_mask,
                                pay: pay,
                                manage: manage
                            }, function (data) {
                                if (data == 'success') {
                                    $.gritter.add({
                                        title: '信息提示!',
                                        text: '办理停车成功!'
                                    });
                                    $("input[name=confirm_enter]").hide();
                                }
                            }, 'text');
                        });
                    }

                });

            });
            $('.check-all').click(function () {
                //alert('123');
//            console.log(0);
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
            $('.btn-del').click(function () {
                var blogs = $('.select_check');
                var blogobj = {};
                for (var i = 0; i < blogs.length; i++) {
//                    console.log(blogs[i].value);
                    if (blogs[i].checked == true) {
                        blogobj[i] = blogs[i].value;
                    }
                }

                $.post('order/del_all', {'name': blogobj}, function (data) {
                    if (data == 'success') {
                        //location.href="facility/index";
                        //console.log(123);
                        datatable.ajax.reload(null, true);//重新加载数据
                        $.gritter.add({
                            title: '信息提示!',
                            text: '记录删除成功!'
                        });
                    }
                }, 'text');

                //console.log(blogobj);

            });
            /*$(this.hash + '-table' + ' tbody').on('click', '.btn-del', function () {
             if (confirm('是否删除该记录，删除后可以在回收站恢复!')) {
             var dataId = $(this).data('id');
             $.get('order/order_del', {orderId: dataId}, function (data) {
             if (data == 'success') {
             datatable.ajax.reload(null, true);//重新加载数据
             $.gritter.add({
             title: '信息提示!',
             text: '记录删除成功!'
             });
             }
             }, 'text');
             }
             return false;
             });*/

            $(this.hash + '-table' + ' tbody').css({cursor: 'pointer'}).on('click', '.show-order-detail', function (e) {
                var orderId = $(this).parent().data('id');
//                console.log(jdjjf);
//            var $self = $(this);
                $.sidepanel({
                    width: 700,
                    title: '订单详情',
                    tpl: 'order_detail-tpl',
                    dataSource: 'order/order_detail',
                    data: {
                        orderId: orderId
                    },
                    callback: function () {
                        $('#order_status').on('change', function () {
                            var selectedVal = $(this).find('option').eq(this.selectedIndex).val();

                            $.get('order/update_order_status', {
                                orderId: orderId,
                                status: selectedVal
                            }, function (data) {
                                if (data == 'success') {
                                    table.ajax.reload(null, true);//重新加载数据
                                    $.gritter.add({
                                        title: '信息提示!',
                                        text: '状态修改成功!'
                                    });
                                }
                            }, 'text');
                        });
                    }

                });
                return false;
            });

            //取消订单
            $(this.hash + '-table' + ' tbody').on('click', '.btn-cancel', function () {
                var orderId = $(this).data('id');
                $.sidepanel({
                    width: 700,
                    title: '取消订单',
                    tpl: 'order-cancel-tpl',
                    dataSource: "order/order_detail",
                    data: {
                        orderId: orderId
                    },
                    callback: function () {
                        //用户取消订单
                        $("input[name=confirm_cancel]").on("click", function () {
                            var pledge = $("input[name=pledge]").val();
                            var enter_mask = $(".mask").val();

                            $.get('order/order_cancel', {
                                orderId: orderId,
                                pledge: pledge,
                                mask: enter_mask
                            }, function (data) {
                                if (data == 'success') {
                                    table.ajax.reload(null, true);//重新加载数据
                                    $.gritter.add({
                                        title: '信息提示!',
                                        text: '取消订单成功!'
                                    });
                                    $('.panel-close').trigger('click');
                                } else {
                                    $.gritter.add({
                                        title: '信息提示!',
                                        text: '取消订单成功!'
                                    });
                                }
                            }, 'text');


                        });
                    }

                });
            });

            //续租
            $(this.hash + '-table' + ' tbody').on('click', '.btn-keep', function () {
                var orderId = $(this).data('id');
                $.sidepanel({
                    width: 700,
                    title: '续租',
                    tpl: 'order-keep-tpl',
                    dataSource: "order/order_detail_keep",
                    data: {
                        orderId: orderId
                    },
                    callback: function () {
                        var data = $("input[name=datearr]").val();
                        var dataArr = data.split(",");
                        dataArr.length = dataArr.length - 1;
                        $('#dpd1').on('click', function () {
                            WdatePicker({minDate: '%y-%M-%d', disabledDates: dataArr});
                        });
                        //点击结束时间的时候判断开始时间
                        $('#dpd2').on('click', function () {
                            if ($('#dpd2').val() != '年-月-日') {
                                WdatePicker({minDate: $('#dpd1').val(), disabledDates: dataArr});
                            } else {
                                WdatePicker({minDate: '%y-%M-%d', disabledDates: dataArr});
                            }
                        });

                        $('#keep-order').on('click', function () {
                            var order_id = $("input[name=order_id]").val(),
                                price = $("input[name=new-price]").val(),
                                return_way = $("input[name=return_way]").val(),
                                start_time = $('#dpd1').val(),
                                end_time = $('#dpd2').val();
                            $.get('order/order_keep', {
                                'order_id': order_id,
                                'price': price,
                                'start_time': start_time,
                                'end_time': end_time
                            }, function (data) {
                                if (data == 'success') {
                                    table.ajax.reload(null, true);//重新加载数据
                                    $.gritter.add({
                                        title: '信息提示!',
                                        text: '续租成功!'
                                    });
                                }
                            }, 'text');
                            $('.fa-times').trigger('click');

                        });
                    }

                });
            });

            e.preventDefault();
        });


        var table = $('#example').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "order/order_mgr",
                "data": function (d) {
                    //添加额外的参数传给服务器
                    var val = $('.reportrange span').html();
//                    var val = $(this.hash + '-table').parent().children('.reportrange span').html();

                    if (val) {
                        d.extra_search = val;
                    } else {
                        var date = moment().subtract('days', 29).format('YYYY-MM-DD') + ',' + moment().format('YYYY-MM-DD')
                        $('.reportrange span').html(date);
                        d.extra_search = date;
                    }
                }
            },
            "columns": [
                null,
                {"data": "order_no"},
                {"data": "order_type"},
                {"data": "title"},
                {"data": "username"},
                {"data": "tel"},
                {"data": "start_time"},
                {"data": "end_time"},
                {"data": "price"},
                {"data": "status"},
                {
                    "width": "40px",
                    "targets": -1,
                    "data": null,
                    "render": function (data, type, row) {
                        return '<a href="javascript:;" class="btn-del" data-id="' + row.order_id + '">删除</a>';
                    }
                }
            ],
            "columnDefs": [
                {
                    "orderable": false,
                    "targets": 0,
                    "render": function (data, type, row) {
                        return '<input type="checkbox" name="del[]" class="select_check" value="' + row.order_id + '">';

                    }
                },
                {"orderable": false, "targets": 3},
                {"orderable": false, "targets": 2},
                {"orderable": false, "targets": 7},
//                {"orderable": false, "targets": 10},
                {
                    "orderable": false,
                    "targets": -1,
                    "data": null,
                    "render": function (data, type, row) {
//                        return '<a href="javascript:;" class="btn-del" data-id="' + row.order_id + '">删除</a>';
                        return '';
                    },
                },
                {"className": "show-order-detail", "targets": [1, 2, 3, 4, 5, 6, 7, 8, 9]}
            ], /*
             "dom":
             "<'row'<'span9'l<'#mytoolbox'>><'span3'f>r>"+
             "t"+
             "<'row'<'span6'i><'span6'p>>"  ,*/
            "order": [[1, 'desc']]
//            initComplete: initComplete
        });

        /**
         * 表格加载渲染完毕后执行的方法
         * @param data
         */
        function initComplete(data) {
            $(".dataTables_wrapper").each(function () {
                $("div", $(this)).first().children(":first").removeClass("col-sm-6").addClass("col-sm-3").next().removeClass("col-sm-6").addClass("col-sm-9");
            });
            var dataPlugin =
                '<div id="" class="pull-left dateRange reportrange" style="width:380px;margin-left: 10px;text-align: center;"> ' +
                '添加日期：<i class="glyphicon glyphicon-calendar fa fa-calendar"></i> ' +
                '<span id="searchDateRange"></span>  ' +
                '<b class="caret"></b></div> ';
            $('.dataTables_filter label').each(function () {
                if ($(this).parent().children(".reportrange").length == 0) {
                    $(this).after(dataPlugin);
                }
            });
            //时间插件
            $('.reportrange span').html(moment().subtract('days', 29).format('YYYY-MM-DD') + ',' + moment().format('YYYY-MM-DD'));

            $('.reportrange').daterangepicker(
                {
                    // startDate: moment().startOf('day'),
                    //endDate: moment(),
                    //minDate: '01/01/2012',    //最小时间
//                    maxDate: moment(), //最大时间
                    dateLimit: {
                        days: 300
                    }, //起止时间的最大间隔
                    showDropdowns: true,
                    showWeekNumbers: false, //是否显示第几周
                    timePicker: false, //是否显示小时和分钟
                    timePickerIncrement: 60, //时间的增量，单位为分钟
                    timePicker12Hour: false, //是否使用12小时制来显示时间
                    ranges: {
                        //'最近1小时': [moment().subtract('hours',1), moment()],
                        '今日': [moment().startOf('day'), moment()],
                        '昨日': [moment().subtract('days', 1).startOf('day'), moment().subtract('days', 1).endOf('day')],
                        '最近7日': [moment().subtract('days', 6), moment()],
                        '最近30日': [moment().subtract('days', 29), moment()]
                    },
                    opens: 'right', //日期选择框的弹出位置
                    buttonClasses: ['btn btn-default'],
                    applyClass: 'btn-small btn-primary blue',
                    cancelClass: 'btn-small',
                    format: 'YYYY-MM-DD', //控件中from和to 显示的日期格式
                    separator: ' to ',
                    locale: {
                        applyLabel: '确定',
                        cancelLabel: '取消',
                        fromLabel: '起始时间',
                        toLabel: '结束时间',
                        customRangeLabel: '自定义',
                        daysOfWeek: ['日', '一', '二', '三', '四', '五', '六'],
                        monthNames: ['一月', '二月', '三月', '四月', '五月', '六月',
                            '七月', '八月', '九月', '十月', '十一月', '十二月'],
                        firstDay: 1
                    }
                }, function (start, end, label) {//格式化日期显示框
                    $('.reportrange span').html(start.format('YYYY-MM-DD') + ',' + end.format('YYYY-MM-DD'));
                });

            //设置日期菜单被选项  --开始--
            var dateOption;
            if ("${riqi}" == 'day') {
                dateOption = "今日";
            } else if ("${riqi}" == 'yday') {
                dateOption = "昨日";
            } else if ("${riqi}" == 'week') {
                dateOption = "最近7日";
            } else if ("${riqi}" == 'month') {
                dateOption = "最近30日";
            } else if ("${riqi}" == 'year') {
                dateOption = "最近一年";
            } else {
                dateOption = "自定义";
            }
            $(".daterangepicker").find("li").each(function () {
                if ($(this).hasClass("active")) {
                    $(this).removeClass("active");
                }
                if (dateOption == $(this).html()) {
                    $(this).addClass("active");
                }
            });
            //设置日期菜单被选项  --结束--


            //选择时间后触发重新加载的方法
            $(".reportrange").on('apply.daterangepicker', function () {
                //当选择时间后，出发dt的重新加载数据的方法
                table.ajax.reload();
                //获取dt请求参数
                var args = table.ajax.params();
            });

            function getParam(url) {
                var data = decodeURI(url).split("?")[1];
                var param = {};
                var strs = data.split("&");

                for (var i = 0; i < strs.length; i++) {
                    param[strs[i].split("=")[0]] = strs[i].split("=")[1];
                }
                return param;
            }
        }

        $('#my-tabs .all-orders').click(function () {
            table.ajax.reload();//重新加载数据，防止在操作过程中数据库中的记录发生变化
        });
        /*$('#example tbody').on('click', '.btn-del', function () {
         if (confirm('是否删除该记录，删除后可以在回收站恢复!')) {
         var dataId = $(this).data('id');
         $.get('order/order_del', {orderId: dataId}, function (data) {
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
         });*/
        $('.check-all').click(function () {
            //alert('123');
//            console.log(0);
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
        /*$('.btn-del').click(function () {
         //            alert(123);
         var blogs = $('.select_check');
         //console.log(123);
         //var arr=[];
         var blogobj = {};
         for (var i = 0; i < blogs.length; i++) {
         //                    console.log(blogs[i].value);
         if (blogs[i].checked == true) {
         blogobj[i] = blogs[i].value;
         }
         }

         $.post('order/del_all', {'name': blogobj}, function (data) {
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

         });*/

        $('#example tbody').css({cursor: 'pointer'}).on('click', '.show-order-detail', function (e) {
            var orderId = $(this).parent().data('id');
//            var $self = $(this);
            $.sidepanel({
                width: 700,
                title: '订单详情',
                tpl: 'order_detail-tpl',
                dataSource: 'order/order_detail',
                data: {
                    orderId: orderId
                },
                callback: function () {
                    $('#order_status').on('change', function () {
                        var selectedVal = $(this).find('option').eq(this.selectedIndex).val();
                        $.get('order/update_order_status', {
                            orderId: orderId,
                            status: selectedVal
                        }, function (data) {
                            if (data == 'success') {
                                table.ajax.reload(null, true);//重新加载数据
                                $.gritter.add({
                                    title: '信息提示!',
                                    text: '状态修改成功!'
                                });
                            }
                        }, 'text');
                    });
                }

            });

        });


        //添加订单
        $("#btn-add").on("click", function () {
            $.sidepanel({
                width: 700,
                title: '添加订单',
                tpl: 'order-add-tpl',
                dataSource: null,
                data: {
                    orderId: null
                },
                callback: function () {
                    $("#dpd1").datepicker({
                        format: 'yyyy-mm-dd'
                    });
                    $("#dpd2").datepicker({
                        format: 'yyyy-mm-dd'
                    });
                    //发票
                    var bFlag = true;
                    $(".need-invoice").on("click", function () {
                        if (bFlag) {
                            bFlag = !bFlag;
                            $(".invoice-input").show();
                            $(this).html("取消");
                        } else {
                            bFlag = !bFlag;
                            $(".invoice-input").hide();
                            $(this).html("需要发票");
                        }
                    });
                    //选择老用户
                    $('#usersearch').on('click', function () {
                        var tel = $('#plot-name').val();
                        $.get('user/tel_search', {
                            'tel': tel
                        }, function (data) {
                            if (data.length > 0) {
                                var user = "<tr><td>用户名：" + data[0].username + " &nbsp;</td><td>真实姓名：" + data[0].rel_name + " &nbsp;</td><td>手机号：" + data[0].tel + " &nbsp;</td><td><button type='button' class='btn btn-default choose-user' style='margin-left: 10px' data-id=" + data[0].user_id + " data-detail=" + data[0].username + ">选择</button></td></tr>";
                                $('.user-table').html("").append(user);
                                $(".choose-user").on("click", function () {
                                    $(".user-choose-end").text($(this).attr("data-detail")).attr("data-id", $(this).attr("data-id"));
                                    $('.close-plot').trigger('click');
                                });
                            } else {
                                var user = $('<p>未查到用户</p>');
                                $('.user-table').html("").append(user);
                            }
                        }, 'json');
                    });
                    //新建用户
                    $(".new-name").on("change", function () {
                        var name = $(".new-name").val();
                        $.get("user/user_help", {name: name}, function (data) {
                            if (data == "yes") {
                                $(".name-help").show().text("用户名已存在!");
                                $(".add-new-user").attr("disabled", true);
                            } else {
                                $(".name-help").show().text("用户名可以使用!");
                                $(".add-new-user").removeAttr("disabled");

                            }
                        }, "text");
                    });
                    $(".new-pwd2").on("change", function () {
                        var pwd = $(".new-pwd").val();
                        var pwd2 = $(this).val();
                        if (pwd != pwd2) {
                            $(".pwd-help").show();
                            $(".add-new-user").attr("disabled", true);
                        } else {
                            $(".pwd-help").hide();
                            $(".add-new-user").removeAttr("disabled");
                        }
                    });
                    $(".add-new-user").on("click", function () {
                        var name = $(".new-name").val(),
                            pwd = $(".new-pwd").val(),
                            tel = $(".new-phone").val();
                        $.get("user/add_new_user_get_id", {name: name, pwd: pwd, tel: tel}, function (data) {
                            if (data == "fail") {
                                alert("添加失败，请重试")
                            } else {
                                $(".user-choose-end").text(name).attr("data-id", data);
                                $('.close-plot').trigger('click');
                            }
                        }, "text");
                    });
                    //选择停车位
                    $(".btn-search-park").on("click", function () {
                        $(".park-table tr").remove();
                        var street = $(".park-street").val();
                        $.get("park/order_search_park", {street: street}, function (data) {
                            if (data.length > 0) {
                                var str = "";
                                for (var i = 0; i < data.length; i++) {
                                    str += "<tr><td>" + data[i].title + "</td><td>" + data[i].street + "." + data[i].region + "</td><td>" + data[i].price + "</td><td><button class='btn btn-default choose-park' style='margin-left: 10px' data-id=" + data[i].park_id + " data-detail=" + data[i].title + "--" + data[i].street + '.' + data[i].region + '--' + data[i].price + ">选择</button></td></tr>"
                                }
                                var park_table = $(str);
                                $(".park-table").html("").append(park_table);
                                $(".choose-park").on("click", function () {
                                    $(".park-choose-end").text($(this).attr("data-detail")).attr("data-id", $(this).attr("data-id"));
                                    $('.close-plot').trigger('click');
                                });
                            } else {
                                var park_table = $('<p>未查到车位</p>');
                                $(".park-table").html("").append(park_table);
                            }
                        }, "json")
                    });
                    $('#add-order').on('click', function () {
                        var park_id = $(".park-choose-end").attr('data-id'),
                            user_id = $(".user-choose-end").attr('data-id'),
                            dpd1 = $('#dpd1').val(),
                            dpd2 = $('#dpd2').val(),
                            price = $('#new-price').val(),
                            status = $('#status').val(),
                            pay = $('input:radio:checked').val();
                        $.get('order/add_order', {
                            'park_id': park_id,
                            'user_id': user_id,
                            'dpd1': dpd1,
                            'dpd2': dpd2,
                            'status': status,
                            'price': price,
                            'pay': pay
                        }, function (data) {
                            if (data == 'success') {
                                table.ajax.reload(null, true);//重新加载数据
                                $.gritter.add({
                                    title: '信息提示!',
                                    text: '订单添加成功!'
                                });
                            }
                        }, 'text');
                        $('.fa-times').trigger('click');

                    });


                }
            });
        });


    });


</script>


</body>
</html>
