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
            <header class="panel-heading custom-tab">
                <!--                            房源数据列表-->
                <ul class="nav nav-tabs " id="my-tabs">
                    <li class="active">
                        <a href="#all-houses" data-toggle="tab" class="all-orders">全部房源</a>
                    </li>
                    <?php foreach ($all_plot as $rs){?>
                        <li>
                            <a href="#" data-value="<?php echo $rs->plot_id?>" data-toggle="tab" class="plot-page"><?php echo $rs->plot_name?></a>
                        </li>
                    <?php }?>
                </ul>
                <!--                    <span class="tools pull-right">-->
                <!--                        <a href="javascript:;" class="fa fa-chevron-down"></a>-->
                <!--                    </span>-->
            </header>
            <div class="directory-info-row">
                <div class="row">
<!--                    <div class="col-md-6 col-sm-6">-->
<!--                        <div class="panel">-->
<!--                            <header class="panel-heading">-->
<!--                                A栋304，哈尔滨梧桐树公寓观景大床房-->
<!--                                <div style="margin-top: -6px;" class="btn-group pull-right">-->
<!--                                    <button class="btn btn-success" type="button">续住</button>-->
<!--                                    <button class="btn btn-info" type="button">结账</button>-->
<!--                                </div>-->
<!--                            </header>-->
<!--                            <div class="panel-body">-->
<!--                                <div class="media">-->
<!--                                    <a class="pull-left text-center" href="#">-->
<!--                                        <img class="thumb media-object" src="uploads/148716736855667.jpg" alt="" width="103" height="103">-->
<!--                                    </a>-->
<!--                                    <div class="media-body">-->
<!--                                        <address>-->
<!--                                            入住状态：已入住<br>-->
<!--                                            入住时间：2017-2-12 至 2017-2-18<br>-->
<!--                                            用户：张三<br>-->
<!--                                            电话：13098763645-->
<!--                                        </address>-->
<!--                                        <ul class="social-links">-->
<!--                                            <li><a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Facebook"><i class="fa fa-thumbs-up"></i></a></li>-->
<!--                                        </ul>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    查询出所有预定的-->
                    <?php foreach ($ordered as $rs){?>
                        <div class="col-md-6 col-sm-6">
                            <div class="panel">
                                <header class="panel-heading">
                                    <?php echo $rs->title?>
                                    <div style="margin-top: -6px;" class="btn-group pull-right" data-id="<?php echo $rs->house_id?>">
                                        <button class="btn btn-success" type="button">续住</button>
                                        <button class="btn btn-info" type="button">结账</button>
                                    </div>
                                </header>
                                <div class="panel-body">
                                    <div class="media">
                                        <a class="pull-left text-center" href="#">
                                            <img class="thumb media-object" src="<?php echo $rs->img_src?>" alt="" width="103" height="103">
                                        </a>
                                        <div class="media-body">
                                            <address>
                                                入住状态：<?php echo $rs->status?><br>
                                                入住时间：<?php echo $rs->start_time?> 至 <?php echo $rs->end_time?><br>
                                                用户：<?php echo $rs->rel_name?><br>
                                                电话：<?php echo $rs->tel?>
                                            </address>
                                            <ul class="social-links">
                                                <?php if($rs->plot_id != ''){?>
                                                    <li><a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Facebook"><i class="fa fa-thumbs-up"></i></a></li>
                                                <?php }?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }?>
<!--                    查询出所有未被预定的-->
                    <?php foreach ($unorder as $rs){?>
                        <div class="col-md-6 col-sm-6">
                            <div class="panel">
                                <header class="panel-heading">
                                    <?php echo $rs->title?>
<!--                                    <div style="margin-top: -6px;" class="btn-group pull-right">-->
<!--                                        <button class="btn btn-success" type="button">续住</button>-->
<!--                                        <button class="btn btn-info" type="button">结账</button>-->
<!--                                    </div>-->
                                </header>
                                <div class="panel-body">
                                    <div class="media">
                                        <a class="pull-left text-center" href="#">
                                            <img class="thumb media-object" src="<?php echo $rs->img_src?>" alt="" width="103" height="103">
                                        </a>
                                        <div class="media-body">
                                            <address>
                                                入住状态：未预定<br>
                                                入住时间：--至 --<br>
                                                用户：--<br>
                                                电话：--
                                            </address>
                                            <ul class="social-links">
                                                <?php if($rs->plot_id != ''){?>
                                                    <li><a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Facebook"><i class="fa fa-thumbs-up"></i></a></li>
                                                <?php }?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }?>


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
<!--ajax-->
<!--续租模板 -->
<script id="order-end-tpl" type="text/html">
    <?php include 'tpls/order_end_tpl.html'; ?>
</script>
<!--结账模板-->
<script id="order-keep-tpl" type="text/html">
    <?php include 'tpls/order_keep_tpl.html'; ?>
</script>
<!--gritter script-->
<script src="js/gritter/js/jquery.gritter.js"></script>

<script src="js/template.js"></script>
<script src="js/jquery.sidepanel.js"></script>


<script>
//    创建AJAXDOM
    function createElem(data,flag) {
        for(var i=0;i<data.length;i++){
            var $container = $('<div class="col-md-6 col-ms-6"></div>');
            var $panel = $('<div class="panel"></div>');
            var $panelHead = $('<header class="panel-heading">'+data[i].title+'</header>');
            if(flag){
                var $btnGroup = $('<div style="margin-top:-6px;" class="btn-group pull-right" data-id="'+data[i].house_id+'"></div>');
                $('<button class="btn btn-success" type="button">续住</button>').on('click',function () {
                    var orderId = $(this).parent().attr('data-id');
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
                    })
                }).appendTo($btnGroup);
                $('<button class="btn btn-info" type="button">结账</button>').on('click',function () {
                    var orderId = $(this).parent().data('id');
                    $.sidepanel({
                        width: 700,
                        title: '结账',
                        tpl: 'order-end-tpl',
                        dataSource: "order/order_detail",
                        data: {
                            orderId: orderId
                        },
                        callback: function () {

                        }

                    });
                }).appendTo($btnGroup);
                $btnGroup.appendTo($panelHead);
            }
            $panelHead.appendTo($panel);
            var $panelBody = $('<div class="panel-body"><div class="media"></div></div>');
            var $img = $('<a class="pull-left text-center" href="#" ><img class="thumb media-object" src="'+data[i].img_src+'" alt="" width="103" height="103"></a>')
                .appendTo($panelBody);
            var $meidiaBody = $('<div class="media-body"></div>');
            if(flag){
                var $msg = $('<address>入住状态:'+data[i].status+'<br> 入住时间：'+data[i].start_time+'至'+data[i].end_time+'<br> 用户：'+data[i].rel_name+'<br> 电话：'+data[i].tel+' </address>');
            }else{
                var $msg = $('<address>入住状态:未预定<br> 入住时间：--至 --<br> 用户：--<br> 电话：-- </address>');
            }
            $msg.appendTo($meidiaBody);
            var $socialLinks = $('<ul class="social-links"><li><a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Facebook"><i class="fa fa-thumbs-up"></i></a></li></ul>');
            $socialLinks.appendTo($meidiaBody);
            $meidiaBody.appendTo($panelBody);
            $panelBody.appendTo($panel);
            $panel.appendTo($container);
            $container.appendTo($('.directory-info-row .row'))
        }

    }
    $(function () {
//        设置panel的固定宽高
        var panelHeight = 0;
        $('.panel').each(function () {
            if($(this).height()>panelHeight){
                panelHeight = $(this).height()
            }
        });
        $('.panel').css('height',panelHeight);
//        标签点击AJAX
        $('#my-tabs li a').on('click',function () {
            var plot = $(this).attr('data-value');
            var parent = $(this).parent();
            if(plot != undefined){
                $.get('House/house_list_plot',{'plot':plot},function (data) {
                    data = JSON.parse(data);
                    $('.directory-info-row .row').empty();
                    createElem(data.ordered,true);
                    createElem(data.unorder,false);
                    parent.addClass('active').siblings().removeClass('active');
                    console.log(parent);
                });
            }else{
                window.location.reload();
            }

            return false;
        });
//        续租侧边框
        $('.btn-group .btn-success').on('click', function () {
            var orderId = $(this).parent().attr('data-id');
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
//        结账侧边框
        $('.btn-group .btn-info').on('click', function () {
            var orderId = $(this).parent().data('id');
            $.sidepanel({
                width: 700,
                title: '结账',
                tpl: 'order-end-tpl',
                dataSource: "order/order_detail",
                data: {
                    orderId: orderId
                },
                callback: function () {

                }

            });
        });
    })
</script>
</body>
</html>
