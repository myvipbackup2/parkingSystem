<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'meta.php'; ?>

    <title>悦居后台管理系统 - 房源管理</title>

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
                房源管理
            </h3>
            <ul class="breadcrumb">
                <li>
                    <a href="#">首页</a>
                </li>
                <li>
                    <a href="#">房源管理</a>
                </li>
                <li class="active"> 房源管理</li>
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
                                    <a href="#all-parks" data-toggle="tab" class="all-orders">全部房源</a>
                                </li>

                            </ul>
                        </header>
                        <div class="panel-body">
                            <div class="tab-content" id="my-tab-pane">
                                <div class="tab-pane active" id="all-parks">
                                    <div class="btn-group">
                                        <button class="btn btn-primary btn-new" type="button">添加 <i
                                                    class="fa fa-plus"></i>
                                        </button>
                                        <button class="btn btn-primary btn-all-del" type="button">删除 <i
                                                    class="fa fa-minus"></i>
                                        </button>
                                        <button id="btn-recommend"  class="btn btn-primary" type="button">推荐 <i
                                                    class="fa fa-thumbs-up"></i>
                                        </button>
                                    </div>
                                    <div class="adv-table">
                                        <table id="example" class="table table-park table-striped table-bordered" cellspacing="0" width="100%">
                                            <thead>
                                            <tr>
                                                <th><input type="checkbox" id="check-all"/></th>
                                                <th>编号</th>
                                                <th>推荐</th>
                                                <th>名称</th>
                                                <th>位置</th>
                                                <th>价格</th>
                                                <th>操作</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="tab-pane" id="recycle">
                                    <button id="btn-recover" class="btn btn-primary" type="button">恢复 <i
                                                class="fa fa-mail-reply-all"></i>
                                    </button>
                                    <div class="adv-table">
                                        <table id="recycle-table" class="table table-park table-striped table-bordered"
                                               cellspacing="0"
                                               width="100%">
                                            <thead>
                                            <tr>
                                                <th><input type="checkbox" id="check-all"/></th>
                                                <th>编号</th>
                                                <th>推荐</th>
                                                <th>名称</th>
                                                <th>位置</th>
                                                <th>价格</th>
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
<!--添加房源中添加设备模板-->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close close-facility" type="button">×</button>
                <h4 class="modal-title">添加设备</h4>
            </div>
            <div class="modal-body">
                <form role="form" class="form-horizontal">
                    <div class="form-group clearfix">
                        <label for="facility-name" class="col-lg-3 col-sm-3 control-label">设备名称</label>
                        <div class="col-lg-8">
                            <input type="text" id="facility-name" name="title" class="form-control" placeholder="请输入设备名称" required>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <label for="is-free" class="col-lg-3 col-sm-3 control-label">是否付费</label>
                        <div class="col-lg-9">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="free[]" id="is-free" value="1">
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                    </div>
                    <div class="form-group">
                        <label for="remark" class="col-lg-3 col-sm-3 control-label">备注</label>
                        <div class="col-sm-8">
                            <!-- 加载编辑器的容器 -->
                            <div id="facility-remark" name="content"></div>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <label class="col-lg-3 col-sm-3 control-label">设备照片</label>
                        <div class="col-lg-8">
                            <div class="fileupload fileupload-new park-upload-box" data-provides="fileupload">
                                <div class="fileupload-new thumbnail park-upload">
                                    <img src="images/photo-upload.jpg" alt="" id="facility-btn">
                                </div>
                                <ul id="facility-pics-box" class="ul_pics clearfix"></ul>
                            </div>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="col-lg-offset-3 col-lg-10">
                            <button type="submit" class="btn btn-primary" id="fac-submit">提交</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal-plot" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close close-plot" type="button">×</button>
                <h4 class="modal-title">添加小区</h4>
            </div>
            <div class="modal-body">
                <form role="form">
                    <div class="form-group clearfix">
                        <label for="facility-name" class="col-lg-3 col-sm-3 control-label">小区名称</label>
                        <div class="col-lg-7">
                            <input type="text" id="plot-name" name="title" class="form-control" placeholder="请输入小区名称">
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <label class="col-lg-3 col-sm-3 control-label">小区介绍</label>
                        <div class="col-sm-8">
                            <!-- 加载编辑器的容器 -->
                            <div id="plot-description" name="content"></div>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <label class="col-lg-3 col-sm-3 control-label">视频链接</label>
                        <div class="col-sm-8">
                            <!-- 加载编辑器的容器 -->
                            <input type="text" id="plot-video" name="video" class="form-control" placeholder="请输入视频链接">
                        </div>
                    </div>
                    <div class="form-group" id="plot-select">
                        <label for="name" class="col-lg-3 col-sm-3 control-label">开发商</label>
                        <div class="col-lg-8">
                            <select class="form-control m-bot15" id="deve" name="deve">
<!--                                {{each deve as deve}}-->
<!--                                <option value="{{deve.developer_id}}">{{deve.developer_name}}</option>-->
<!--                                {{/each}}-->
                            </select>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="col-lg-offset-2 col-lg-10">
                            <button type="submit" class="btn btn-primary" id="plot-submit">提交</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal-2" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">房屋推荐理由</h4>
            </div>
            <div class="modal-body">
                <div class="form-inline" role="form">
                    <div class="form-group">
                        <label class="sr-only" for="exampleInputEmail2">推荐理由</label>
                        <textarea type="text" class="form-control sm-input" id="exampleInputEmail5" placeholder="请输入推荐理由"></textarea>
                    </div>
                    <button type="submit" class="rec-btn-reason btn btn-primary">提交</button>
                </div>

            </div>

        </div>
    </div>
</div>
<!-- templates -->
<script id="park-tpl" type="text/html">
    <?php include 'tpls/park_tpl.html'; ?>
</script>

<script id="new-park-tpl" type="text/html">
    <?php include 'tpls/new_park_tpl.html'; ?>
</script>

<script id="edit-park-tpl" type="text/html">
    <?php include 'tpls/edit_park_tpl.html'; ?>
</script>
<script id="add-combo-tpl" type="text/html">
    <?php include 'tpls/add_combo_tpl.html'; ?>
</script>

<!-- Placed js at the end of the document so the pages load faster -->
<script src="js/jquery-1.12.4.min.js"></script>
<script src="js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="js/jquery-ui-1.10.3.min.js"></script>
<script src="js/jquery-migrate-1.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/modernizr.min.js"></script>
<script src="js/jquery.nicescroll.js"></script>


<script src="js/jquery.validate.min.js"></script>

<!--datatables script-->
<script src="js/datatables/js/jquery.dataTables.min.js"></script>
<script src="js/datatables/js/dataTables.bootstrap.js"></script>

<!--gritter script-->
<script src="js/gritter/js/jquery.gritter.js"></script>

<!--plupload script-->
<script src="js/plupload.full.min.js"></script>

<!--validate script-->
<script src="js/jquery.validate.min.js"></script>

<script src="js/template.js"></script>
<script src="js/jquery.sidepanel.js"></script>
<script src="js/city.js"></script>
<!--pickers plugins-->
<script type="text/javascript" src="js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<!-- ueditor 配置文件 -->
<script src="js/ueditor/ueditor.config.js"></script>
<!-- ueditor 编辑器源码文件 -->
<script src="js/ueditor/ueditor.all.min.js"></script>

<!--common scripts for all pages-->
<script src="js/scripts.js"></script>

<script>
    $(function () {
        $.get('park/get_plot',{},function(rs_plot){
            for(var i=0;i<rs_plot.length;i++){
                $("#my-tabs").append('<li order-status="'+i+'" class="plot-page"><a href="#plot'+i+'" class="plot-btn" data-toggle="tab" plot-id="'+rs_plot[i].plot_id+'">'+rs_plot[i].plot_name+'</a></li>');
                $("#my-tab-pane").append('<div class="tab-pane" id="plot'+i+'"><div class="btn-group"><button class="btn btn-primary btn-new" type="button">添加 <iclass="fa fa-plus"></i> </button> <button class="btn btn-primary btn-all-del" type="button">删除 <iclass="fa fa-minus"></i> </button> <button id="btn-recommend"  class="btn btn-primary" type="button">推荐 <i class="fa fa-thumbs-up"></i> </button> </div> <div class="adv-table"> <table id="plot'+i+'" class="table table-park table-striped table-bordered plot-table" cellspacing="0" width="100%"> <thead> <tr> <th><input type="checkbox" id="check-all"/></th> <th>编号</th> <th>推荐</th> <th>名称</th> <th>位置</th> <th>价格</th> <th>操作</th> </tr> </thead> <tbody> </tbody> </table> </div> </div>');
            }
            $("#my-tabs").append('<li class=""> <a href="#recycle" data-toggle="tab" class="recycle">回收站</a></li>');
        },'json');


        $('.wrapper').on('click','.btn-new',function () {
            $.sidepanel({
                width: 700,
                title: '添加房源',
                tpl: 'new-park-tpl',
                dataSource: 'park/get_facility_plot',
                callback: function () {//sidepanel显示后的后续操作，主要是针对sidepanel中的元素的dom操作

                    //处理可售多选框
                    $('#is-sale').on('change',function(){
                        var $checked = $(this).prop('checked');
                        var $formGroup = $(this).parents('div.form-group').nextAll('div.sale-park');
                        if($checked){
                            $formGroup.show();
                        }else{
                            $formGroup.hide();
                        }
                    });



                    //处理付费多选框
                    $('#is-free').on('change',function(){
                        var $checked = $(this).prop('checked');
                        var $formGroup = $(this).parents('div.form-group').next('div.form-group');
                        if($checked){
                            var str = '<label for="price" class="col-lg-3 col-sm-3 control-label">价格</label>' +
                                '<div class="col-lg-8">' +
                                '<input type="text" id="facility-price" name="price" class="form-control">' +
                                '</div>';
                            $formGroup.html(str);
                        }else{
                            $formGroup.html("");
                        }
                    });

                    //实例化编辑器
                    UE.delEditor('new-container');
                    var ue = UE.getEditor('new-container',{
                        initialFrameWidth:470  //初始化编辑器宽度
                        ,initialFrameHeight:200  //初始化编辑器高度
                    });

                    //添加设备实例化编辑器
                    UE.delEditor('facility-remark');
                    facility_ue = UE.getEditor('facility-remark',{
                        initialFrameWidth:375  //初始化编辑器宽度
                    });

                    //添加小区实例化编辑器
                    UE.delEditor('plot-description');
                    plot_ue = UE.getEditor('plot-description',{
                        initialFrameWidth:375  //初始化编辑器宽度
                    });


                    //省市联动
                    cityInit('hometown', 'city', 'position', '黑龙江', '哈尔滨', '市辖区');

                    /*户型选择自动跳下一个*/
                    $('.park-type input').on('keyup', function () {
                        if ($('.park-type input').index($(this)) == 2) {
                            $('#park-price').trigger('focus');
                        } else {
                            $(this).parents('.park-type').next().find('input').trigger('focus');
                        }
                    });

                    //验证组件开始
                    $.validator.setDefaults({
                        submitHandler: function() {
                            $("#park-msg").val(ue.getContent());
                            $("#notice").val(notice.getContent());
                            $("#traffic").val(traffic.getContent());
                            $('#commentForm').submit();
                        }
                    });

                    $().ready(function() {
                        // validate the comment form when it is submitted
                        $("#commentForm").validate({
                            rules: {
                                title:{
                                    required: true,
                                    rangelength:[6,30]
                                },
//                                name: {
//                                    required: true,
//                                    rangelength:[2,20]
//                                },
                                address:'required',
                                bedroom:{
                                    required: true,
                                    number: true
                                },
                                livingroom:{
                                    required: true,
                                    number: true
                                },
                                toilet:{
                                    required: true,
                                    number: true
                                },
                                price:{
                                    required: true,
                                    number: true
                                }
                            },
                            messages: {
                                title:{
                                    required: "忘记填写标题啦",
                                    rangelength: "标题长度要在6-30个字之间"
                                },
//                                name: {
//                                    required: "忘记填写小区名啦",
//                                    rangelength: "小区名称长度要在2-20个字之间"
//                                },
                                address: "忘记填写小区详细地址啦",
                                bedroom:{
                                    required: "忘记填写室啦",
                                    number: "请填写数字"
                                },
                                livingroom:{
                                    required: "忘记填写厅啦",
                                    number: "请填写数字"
                                },
                                toilet:{
                                    required: "忘记填写卫啦",
                                    number: "请填写数字"
                                },
                                price:{
                                    required: "忘记填写价格啦",
                                    number: "填写有误，请填写数字"
                                }
                            }
                        });

                    });
                    //验证组件结束

                    //图片上传代码开始
                    var uploader = new plupload.Uploader({ //创建实例的构造方法
                        runtimes: 'html5,flash,silverlight,html4', //上传插件初始化选用那种方式的优先级顺序
                        browse_button: 'btn', // 上传按钮
                        url: "img_upload", //远程上传地址
                        filters: {
                            max_file_size: '500kb', //最大上传文件大小（格式100b, 10kb, 10mb, 1gb）
                            mime_types: [ //允许文件上传类型
                                {
                                    title: "files",
                                    extensions: "jpg,png,gif,ico,jpeg"
                                }
                            ]
                        },
                        multi_selection: true, //true:ctrl多文件上传, false 单文件上传
                        init: {
                            FilesAdded: function(up, files) { //文件上传前
                                if ($("#ul_pics").children("li").length > 30) {
                                    alert("您上传的图片太多了！");
                                    uploader.destroy();
                                } else {
                                    var li = '';
                                    plupload.each(files, function(file) { //遍历文件
                                        li += "<li id='" + file['id'] + "'><div class='progress'><span class='bar'></span><span class='percent'>0%</span></div></li>";
                                    });
//                                    $("#ul_pics").append(li);
                                    $('.park-upload-btn').before(li);
                                    uploader.start();
                                }
                            },
                            UploadProgress: function(up, file) { //上传中，显示进度条
                                var percent = file.percent;
                                $("#" + file.id).find('.bar').css({
                                    "width": percent + "%"
                                });
                                $("#" + file.id).find(".percent").text(percent + "%");
                            },
                            FileUploaded: function(up, file, info) { //文件上传成功的时候触发
                                var data = eval("(" + info.response + ")");
                                $("#" + file.id).html("<div class='img'><img src='" + data.pic + "'/><a class='del-img upload-del-btn'></a></div><p><input type='hidden' name='upload_img[]' value='"+ data.pic +"'></p>");
                            },
                            Error: function(up, err) { //上传出错的时候触发
                                alert(err.message);
                            }
                        }
                    });
                    uploader.init();
                    //鼠标滑入div,显示删除按钮
                    $('#ul_pics').on('mouseover','div.img',function () {
                        var $delImg = $(this).children('.del-img').show();
                    }).on('mouseout','div.img',function () {
                        var $delImg = $(this).children('.del-img').hide();
                    });

                    //图片删除
                    $('#ul_pics').on('click','.del-img',function () {
                        $(this).parents('li').remove();
                    });
                    //图片上传代码结束
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

        $('.wrapper').on('click','.btn-all-del',function () {

            var blogs = $('.select_check:checked');
            var blogobj = [];
            for (var i = 0; i < blogs.length; i++) {
                blogobj.push(blogs[i].value);
            }
            if(blogobj.length == 0){
                $.gritter.add({
                    title: '信息提示!',
                    text: '请选择要删除的记录!'
                });
            }else{
                $.get('park/del_all', {name: blogobj}, function (data) {
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

        //房源列表
        var table = $('#example').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "park/park_mgr",
            "columns": [
                {
                    "width": "16px",
                    "className": "text-center",
                    "data": null,
                    "render": function (data, type, row) {
                        return '<input type="checkbox" name="del[]" value="' + row.park_id + '" class="cb-park-id select_check"/>'
                    }
                },
                {"width": "30px", "data": "park_id", "className": "text-center"},
                {
                    "width": "30px",
                    "className": "text-center recommend-line",
                    "data": null,
                    "render": function (data, type, row) {
                        var str_rec = '';
                        //console.log(row.is_rec);
                        if(row.is_rec=='1'){
                            str_rec='recommend-red';
                        }else{
                            str_rec='';
                        }
                        //console.log(str_rec);
                        return '<a href="javascript:;" class="btn-recommend btn btn-xs btn-success '+str_rec+'" data-toggle="modal" data-id="' + row.park_id + '"><i class="fa  fa-thumbs-o-up"></i></a>'
                    }
                },
                {"data": "title"},
                {
                    "width": "90px",
                    "data": "street"
                },
                {"data": "price"},
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return '<a href="javascript:;" class="btn-edit">编辑 <i class="fa fa-edit"></i></a> | <a href="javascript:;" class="btn-del" data-id="' + row.park_id + '">删除 <i class="fa fa-times"></i></a> | <a href="javascript:;" class="btn-add-combo">添加套餐</a>';
                    },
                }
            ],
            "columnDefs": [
                {"orderable": false, "targets": [0, 2, 3, 4, 6]},
                {"className": "clicked-cell", "targets": [3, 4, 5]},
            ],
            "order": [[1, 'desc']]
        });
        $('#my-tabs a.all-parks').click(function (e) {
            table.ajax.reload();//切换标签时重新加载数据
        });
        $('#my-tabs a.recycle').click(function (e) {
            var table = $('#recycle-table').DataTable({
                "processing": true,
                "serverSide": true,
                "retrieve": true,
                "ajax": "park/get_del_park",
                "columns": [
                    {
                        "width": "16px",
                        "className": "text-center",
                        "data": null,
                        "render": function (data, type, row) {
                            return '<input type="checkbox" value="' + row.park_id + '" class="cb-recover-park-id"/>'
                        }
                    },
                    {"width": "30px", "data": "park_id", "className": "text-center"},
                    {
                        "width": "30px",
                        "className": "text-center recommend-line",
                        "data": null,
                        "render": function (data, type, row) {
                            var str_rec = '';
                           // console.log(row.is_rec);
                            if(row.is_rec=='1'){
                                str_rec='recommend-red';
                            }else{
                                str_rec='';
                            }
                            return '<a href="javascript:;" class="btn-recommend btn btn-xs btn-success'+str_rec+'" data-id="' + row.park_id + '"><i class="fa  fa-thumbs-o-up"></i></a>'
                        }
                    },
                    {"data": "title"},
                    {"data": "street"},
                    {"data": "price"},
                    {
                        "data": null,
                        "render": function (data, type, row) {
                            return '<a href="javascript:;" class="btn-recover" data-id="' + row.park_id + '">恢复 <i class="fa fa-mail-reply"></i></a>';
                        },
                    }
                ],
                "columnDefs": [
                    {"orderable": false, "targets": [0, 2, 3, 4, 6]},
                    {"className": "clicked-cell", "targets": [3, 4, 5]},

                ],
                "order": [[1, 'desc']]
            });
            table.ajax.reload();
            $(this).tab('show');
            e.preventDefault();
        });

        $('#my-tabs').on('click','.plot-btn',function (e) {

            var plot_id=$(this).attr('plot-id');
            var $idx = $(this).parent().index();
            var table = $('.plot-table').eq($idx-1).DataTable({
                "processing": true,
                "serverSide": true,
                "retrieve": true,
                "ajax": {
                    url:"park/plot_park",
                    data:{'plot_id':plot_id}
                },
                "columns": [
                    {
                        "width": "16px",
                        "className": "text-center",
                        "data": null,
                        "render": function (data, type, row) {
                            return '<input type="checkbox" name="del[]" value="' + row.park_id + '" class="cb-recover-park-id select_check"/>'
                        }
                    },
                    {"width": "30px", "data": "park_id", "className": "text-center"},
                    {
                        "width": "30px",
                        "className": "text-center recommend-line",
                        "data": null,
                        "render": function (data, type, row) {
                            var str_rec = '';
                           // console(row.is_rec)
                            if(row.is_rec=='1'){
                                str_rec='recommend-red';
                            }else{
                                str_rec='';
                            }
                            return '<a href="javascript:;" class="btn-recommend btn btn-xs btn-success '+str_rec+'" data-id="' + row.park_id + '"><i class="fa  fa-thumbs-o-up"></i></a>'
                        }
                    },
                    {"data": "title"},
                    {"data": "street"},
                    {"data": "price"},
                    {
                        "data": null,
                        "render": function (data, type, row) {
                            return '<a href="javascript:;" class="btn-edit">编辑 <i class="fa fa-edit"></i></a> | <a href="javascript:;" class="btn-del" data-id="' + row.park_id + '">删除 <i class="fa fa-times"></i></a>';
                        },
                    }
                ],
                "columnDefs": [
                    {"orderable": false, "targets": [0, 2, 3, 4, 6]},
                    {"className": "clicked-cell", "targets": [3, 4, 5]},

                ],
                "order": [[1, 'desc']]
            });
            table.ajax.reload();
            $(this).tab('show');
            e.preventDefault();
        });
        $('#my-tab-pane').on('click', '.btn-del', function () {
            if (confirm('是否删除该记录，删除后可以在回收站恢复!')) {
                var dataId = $(this).data('id');
                $.get('park/park_del', {parkId: dataId}, function (data) {
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


        /*****点击表格显示记录查情*****/
        $('#my-tab-pane').on('click', '.clicked-cell', function () {
//            console.log('aa');
//            alert(123);
            var dataId = $(this).parent().data('id');
            console.log(dataId);

            $.sidepanel({
                width: 700,
                title: '房源详情',
                tpl: 'park-tpl',
                dataSource: 'park/park_detail',
                data: {
                    parkId: dataId
                },
                callback: function () {//sidepanel显示后的后续操作，主要是针对sidepanel中的元素的dom操作
                    var $is_sale = $('#is_sale').attr('name');
                    if($is_sale == 1){
                        $('div.sale-park').show();
                    }

                    //处理可售多选框
                    $('#is-sale').on('change',function(){
                        var $checked = $(this).prop('checked');
                        var $formGroup = $(this).parents('div.form-group').nextAll('div.sale-park');
                        if($checked){
                            $formGroup.show();
                        }else{
                            $formGroup.hide();
                        }
                    });


                    $('#order-table').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "ajax": "park/park_orders?parkId=" + dataId,
                        "columns": [
                            {"data": "order_id"},
                            {"data": "start_time"},
                            {"data": "end_time"},
                            {"data": "price"},
                            {"data": "order_status"}
                        ],
                        "pageLength": 2
                    });

                    //验证组件开始
                    $.validator.setDefaults({
                        submitHandler: function() {
                            $("#park-msg").val(ue.getContent());
                            $('#editForm').submit();
                        }
                    });

                    $().ready(function() {
                        // validate the comment form when it is submitted
                        $("#editForm").validate({
                            rules: {
                                title:{
                                    required: true,
                                    rangelength:[6,30]
                                },
                                name: {
                                    required: true,
                                    rangelength:[2,20]
                                },
                                address:'required',
                                bedroom:{
                                    required: true,
                                    number: true
                                },
                                livingroom:{
                                    required: true,
                                    number: true
                                },
                                toilet:{
                                    required: true,
                                    number: true
                                },
                                price:{
                                    required: true,
                                    number: true
                                }
                            },
                            messages: {
                                title:{
                                    required: "忘记填写标题啦",
                                    rangelength: "标题长度要在6-30个字之间"
                                },
                                name: {
                                    required: "忘记填写小区名啦",
                                    rangelength: "小区名称长度要在2-20个字之间"
                                },
                                address: "忘记填写小区详细地址啦",
                                bedroom:{
                                    required: "忘记填写室啦",
                                    number: "请填写数字"
                                },
                                livingroom:{
                                    required: "忘记填写厅啦",
                                    number: "请填写数字"
                                },
                                toilet:{
                                    required: "忘记填写卫啦",
                                    number: "请填写数字"
                                },
                                price:{
                                    required: "忘记填写价格啦",
                                    number: "填写有误，请填写数字"
                                }
                            }
                        });

                    });
                    //验证组件结束

                    //实例化编辑器
                    UE.delEditor('edit-container');
                    var ue = UE.getEditor('edit-container',{
                        initialFrameWidth:470  //初始化编辑器宽度
                        ,initialFrameHeight:200  //初始化编辑器高度
                    });

                    ue.ready(function() {
                        //设置编辑器的内容
                        ue.setContent($('#park-msg').val());
                    });
                    cityInit('hometown', 'city', 'position', $('input[name=hometown_hidden]').val(), $('input[name=city_hidden]').val(), $('input[name=position_hidden]').val());

                    $('.park-to-edit').on('click',function(){
                        $('.park-detail-box').hide();
                        $('.park-edit-box').show();
                    });
                    $('.park-to-detail').on('click',function(){
                        $('.park-detail-box').show();
                        $('.park-edit-box').hide();
                    });

                    //添加房源图片上传
                    var uploader = new plupload.Uploader({ //创建实例的构造方法
                        runtimes: 'html5,flash,silverlight,html4', //上传插件初始化选用那种方式的优先级顺序
                        browse_button: 'edit_park_img_btn', // 上传按钮
                        url: "img_upload", //远程上传地址
                        filters: {
                            max_file_size: '500kb', //最大上传文件大小（格式100b, 10kb, 10mb, 1gb）
                            mime_types: [ //允许文件上传类型
                                {
                                    title: "files",
                                    extensions: "jpg,png,ico,jpeg"
                                }
                            ]
                        },
                        multi_selection: false, //true:ctrl多文件上传, false 单文件上传
                        init: {
                            FilesAdded: function(up, files) { //文件上传前
                                if ($("#ul_pics_edit").children("li").length > 30) {
                                    alert("您上传的图片太多了！");
                                    uploader.destroy();
                                } else {
                                    var li = '';
                                    plupload.each(files, function(file) { //遍历文件
                                        li += "<li id='" + file['id'] + "'><div class='progress'><span class='bar'></span><span class='percent'>0%</span></div></li>";
                                    });
//                                    $("#ul_pics_edit").append(li);
                                    $('.park-upload-btn').before(li);
                                    uploader.start();
                                }
                            },
                            UploadProgress: function(up, file) { //上传中，显示进度条
                                var percent = file.percent;
                                $("#" + file.id).find('.bar').css({
                                    "width": percent + "%"
                                });
                                $("#" + file.id).find(".percent").text(percent + "%");
                            },
                            FileUploaded: function(up, file, info) { //文件上传成功的时候触发
                                var data = eval("(" + info.response + ")");
                                $("#" + file.id).html("<div class='img'><img src='" + data.pic + "'/><a class='del-img upload-del-btn'></a></div><p><input type='hidden' name='upload_img[]' value='"+ data.pic +"'></p>");
                            },
                            Error: function(up, err) { //上传出错的时候触发
                                alert(err.message);
                            }
                        }
                    });
                    uploader.init();

                    //鼠标滑入div,显示删除按钮
                    $('#ul_pics_edit').on('mouseover','div.img',function () {
                        var $delImg = $(this).children('.upload-del-btn').show();
                    }).on('mouseout','div.img',function () {
                        var $delImg = $(this).children('.upload-del-btn').hide();
                    });
                    //图片删除
                    $('#ul_pics_edit').on('click','.init-del-img',function () {
                        var $img_id = $(this).attr('img_id');
                        $(this).parents('.park-upload-box').append("<input type='hidden' name='del_img_id[]' value='"+$img_id+"'>");
                        $(this).parents('li').remove();
                    });

                    //新添加图片删除
                    $('#ul_pics_edit').on('click','.del-img',function () {
                        $(this).parents('li').remove();
                    });
                    //图片上传代码结束
                }
            });
        });
        //添加套餐btn-add-combo

        $('#my-tab-pane').on('click', '.btn-add-combo', function () {

            var dataId = $(this).parents('tr').data('id');

            $.sidepanel({
                width: 700,
                title: '添加房源套餐',
                tpl: 'add-combo-tpl',
                dataSource: 'combo/get_combo_type',
                data: {
                    parkId: dataId
                },
                callback: function () {
                    $(".combo-time").datepicker({
                        format: 'yyyy-mm-dd'
                    });

                }
            });
        });


        /*****点击编辑按钮*****/
        $('#my-tab-pane').on('click', '.btn-edit', function () {

            var dataId = $(this).parents('tr').data('id');

            $.sidepanel({
                width: 700,
                title: '编辑房源',
                tpl: 'edit-park-tpl',
                dataSource: 'park/park_detail',
                data: {
                    parkId: dataId
                },
                callback: function () {//sidepanel显示后的后续操作，主要是针对sidepanel中的元素的dom操作

                    var checked = $('#is-sale').prop('checked');
                    if(checked){
                        $('div.sale-park').show();
                    }

                    //处理可售多选框
                    $('#is-sale').on('change',function(){
                        var $checked = $(this).prop('checked');
                        var $formGroup = $(this).parents('div.form-group').nextAll('div.sale-park');
                        if($checked){
                            $formGroup.show();
                        }else{
                            $formGroup.hide();
                        }
                    });

                    //验证组件开始
                    $.validator.setDefaults({
                        submitHandler: function() {
                            $("#park-msg").val(ue.getContent());
                            $('#editForm').submit();
                        }
                    });

                    $().ready(function() {
                        // validate the comment form when it is submitted
                        $("#editForm").validate({
                            rules: {
                                title:{
                                    required: true,
                                    rangelength:[6,30]
                                },
                                name: {
                                    required: true,
                                    rangelength:[2,20]
                                },
                                address:'required',
                                bedroom:{
                                    required: true,
                                    number: true
                                },
                                livingroom:{
                                    required: true,
                                    number: true
                                },
                                toilet:{
                                    required: true,
                                    number: true
                                },
                                price:{
                                    required: true,
                                    number: true
                                }
                            },
                            messages: {
                                title:{
                                    required: "忘记填写标题啦",
                                    rangelength: "标题长度要在6-30个字之间"
                                },
                                name: {
                                    required: "忘记填写小区名啦",
                                    rangelength: "小区名称长度要在2-20个字之间"
                                },
                                address: "忘记填写小区详细地址啦",
                                bedroom:{
                                    required: "忘记填写室啦",
                                    number: "请填写数字"
                                },
                                livingroom:{
                                    required: "忘记填写厅啦",
                                    number: "请填写数字"
                                },
                                toilet:{
                                    required: "忘记填写卫啦",
                                    number: "请填写数字"
                                },
                                price:{
                                    required: "忘记填写价格啦",
                                    number: "填写有误，请填写数字"
                                }
                            }
                        });

                    });
                    //验证组件结束
                    UE.delEditor('container');
                    //实例化编辑器
                    var ue = UE.getEditor('container',{
                        initialFrameWidth:470  //初始化编辑器宽度
                        ,initialFrameHeight:200  //初始化编辑器高度
                    });

                    ue.ready(function() {
                        //设置编辑器的内容
                        ue.setContent($('#park-msg').val());
                    });

                    cityInit('hometown', 'city', 'position', $('input[name=hometown_hidden]').val(), $('input[name=city_hidden]').val(), $('input[name=position_hidden]').val());


                    //添加房源图片上传
                    var uploader = new plupload.Uploader({ //创建实例的构造方法
                        runtimes: 'html5,flash,silverlight,html4', //上传插件初始化选用那种方式的优先级顺序
                        browse_button: 'edit_park_img_btn', // 上传按钮
                        url: "img_upload", //远程上传地址
                        filters: {
                            max_file_size: '500kb', //最大上传文件大小（格式100b, 10kb, 10mb, 1gb）
                            mime_types: [ //允许文件上传类型
                                {
                                    title: "files",
                                    extensions: "jpg,png,ico,jpeg"
                                }
                            ]
                        },
                        multi_selection: false, //true:ctrl多文件上传, false 单文件上传
                        init: {
                            FilesAdded: function(up, files) { //文件上传前
                                if ($("#ul_pics_edit").children("li").length > 30) {
                                    alert("您上传的图片太多了！");
                                    uploader.destroy();
                                } else {
                                    var li = '';
                                    plupload.each(files, function(file) { //遍历文件
                                        li += "<li id='" + file['id'] + "'><div class='progress'><span class='bar'></span><span class='percent'>0%</span></div></li>";
                                    });
//                                    $("#ul_pics_edit").append(li);
                                    $('.park-upload-btn').before(li);
                                    uploader.start();
                                }
                            },
                            UploadProgress: function(up, file) { //上传中，显示进度条
                                var percent = file.percent;
                                $("#" + file.id).find('.bar').css({
                                    "width": percent + "%"
                                });
                                $("#" + file.id).find(".percent").text(percent + "%");
                            },
                            FileUploaded: function(up, file, info) { //文件上传成功的时候触发
                                var data = eval("(" + info.response + ")");
                                $("#" + file.id).html("<div class='img'><img src='" + data.pic + "'/><a class='del-img upload-del-btn'></a></div><p><input type='hidden' name='upload_img[]' value='"+ data.pic +"'></p>");
                            },
                            Error: function(up, err) { //上传出错的时候触发
                                alert(err.message);
                            }
                        }
                    });
                    uploader.init();

                    //鼠标滑入div,显示删除按钮
                    $('#ul_pics_edit').on('mouseover','div.img',function () {
                        var $delImg = $(this).children('.upload-del-btn').show();
                    }).on('mouseout','div.img',function () {
                        var $delImg = $(this).children('.upload-del-btn').hide();
                    });
                    //图片删除
                    $('#ul_pics_edit').on('click','.init-del-img',function () {
                        var $img_id = $(this).attr('img_id');
                        $(this).parents('.park-upload-box').append("<input type='hidden' name='del_img_id[]' value='"+$img_id+"'>");
                        $(this).parents('li').remove();
                    });

                    //新添加图片删除
                    $('#ul_pics_edit').on('click','.del-img',function () {
                        $(this).parents('li').remove();
                    });
                    //图片上传代码结束
                }
            });
        });

        /*****显示页面帮助功能*****/
        $('.help').on('click', function () {
            $.gritter.add({
                sticky: true,
                title: '本页面帮助!',
                text: 'xxxxxxxxxxxx!'
            });
        });
        /*****推荐房源*****/
        $('.btn-recommend').on('click', function () {
            var rec_some=[];
            $('body').append('<div class="modal-backdrop fade in"></div>');
            $('body').addClass('modal-open');
            $("#myModal-2").css({'display':'block'}).addClass('in');
            $('.cb-park-id:checked', $('#example')).each(function (i) {
                rec_some[i]=this.value;
            });
            var rec_reason = '';
            $("button.close").on('click', function () {
                $(".modal.fade.in").css({'display':'none'});
                $(".modal.fade.in").removeClass('in');
                $(".modal-backdrop.fade.in").remove();
            });
            $(".rec-btn-reason").on('click',function(){
                for(var j=0;j<$('.cb-park-id').length;j++){
                    if($('#example tbody tr').eq(j).find('.cb-park-id').prop('checked')){
                        $('#example tbody tr').eq(j).find('.btn-recommend').addClass('recommend-red');
                    }
                }
                rec_reason = $("#exampleInputEmail5").val();
                $(".modal.fade.in").css({'display':'none'});
                $(".modal.fade.in").removeClass('in');
                $(".modal-backdrop.fade.in").remove();
                var rec_some_str=rec_some.join('.');
                $.get('park/recommend_add_some',{'rec_some':rec_some_str,'rec_reason':rec_reason},function(rec_rs){
//                    console.log(rec_rs);
                },'json');
            });
            $("#exampleInputEmail5").val('');
        });
        var aCheckIndex = 0;
        $("#my-tab-pane").on('click','#check-all',function(){
                    if (aCheckIndex==0) {
                        $('.cb-park-id').prop("checked",true);
                        aCheckIndex=1;
                    }
                    else if (aCheckIndex==1) {
                        $('.cb-park-id').prop("checked",false);
                        aCheckIndex=0;
                    }
        });
        $('#my-tab-pane').on('click', '.btn-recommend', function () {
            var recommend_index=$(this).parent().parent().index();
            console.log($(this));
            var rec_id = $(this).attr('data-id');
            console.log(rec_id);
            var rec_reason='';
            if($(this).hasClass('recommend-red')){
                $(this).prop('href',"javascript:;");
                var r=confirm("是否取消推荐")
                if (r==true)
                {
                    $.get('park/recommend_del',{'rec_id':rec_id},function($rs){
                        console.log($rs);
                    },'text');
                    $(this).removeClass('recommend-red');
                }
                else{
                }


            }else{
                $(this).prop('href',"#myModal-2");
                $(".rec-btn-reason").on('click',function(){
                    rec_reason = $("#exampleInputEmail5").val();
                    $('#example tbody tr').eq(recommend_index).find('.btn-recommend').addClass('recommend-red');
                    $(".modal.fade.in").css({'display':'none'});
                    $(".modal.fade.in").removeClass('in');
                    $(".modal-backdrop.fade.in").remove();
                    $.get('park/recommend_add',{'rec_id':rec_id,'rec_reason':rec_reason},function($rec_rs){
                    },'text');
                });
                $("#exampleInputEmail5").val('');
            }
        });
        //添加设备图片上传
        var uploader = new plupload.Uploader({ //创建实例的构造方法
            runtimes: 'html5,flash,silverlight,html4', //上传插件初始化选用那种方式的优先级顺序
            browse_button: 'facility-btn', // 上传按钮
            url: "img_upload_facility", //远程上传地址
            filters: {
                max_file_size: '500kb', //最大上传文件大小（格式100b, 10kb, 10mb, 1gb）
                mime_types: [ //允许文件上传类型
                    {
                        title: "files",
                        extensions: "jpg,png,ico,jpeg"
                    }
                ]
            },
            multi_selection: false, //true:ctrl多文件上传, false 单文件上传
            init: {
                FilesAdded: function(up, files) { //文件上传前
                    if ($("#facility-pics-box").children("li").length > 30) {
                        alert("您上传的图片太多了！");
                        uploader.destroy();
                    } else {
                        var li = '';
                        plupload.each(files, function(file) { //遍历文件
                            li += "<li id='" + file['id'] + "'><div class='progress'><span class='bar'></span><span class='percent'>0%</span></div></li>";
                        });
                        $("#facility-pics-box").append(li);
                        uploader.start();
                    }
                },
                UploadProgress: function(up, file) { //上传中，显示进度条
                    var percent = file.percent;
                    $("#" + file.id).find('.bar').css({
                        "width": percent + "%"
                    });
                    $("#" + file.id).find(".percent").text(percent + "%");
                },
                FileUploaded: function(up, file, info) { //文件上传成功的时候触发
                    var data = eval("(" + info.response + ")");
                    $("#" + file.id).html("<div class='img'><img src='" + data.pic + "'/><a class='del-img upload-del-btn'></a></div><p><input type='hidden' id='facility_img' name='facility_img' value='"+ data.pic +"'></p>");
                },
                Error: function(up, err) { //上传出错的时候触发
                    alert(err.message);
                }
            }
        });
        uploader.init();

        //鼠标滑入div,显示删除按钮
        $('#facility-pics-box').on('mouseover','div.img',function () {
            var $delImg = $(this).children('.del-img').show();
        }).on('mouseout','div.img',function () {
            var $delImg = $(this).children('.del-img').hide();
        });

        //图片删除
        $('#facility-pics-box').on('click','.del-img',function () {
            $(this).parents('li').remove();
        });
        //图片上传代码结束

        /*添加房源->添加设备*/
        $('#fac-submit').on('click',function(e){
            e.preventDefault();
            $name = $('#facility-name').val();
            $img = $('#facility_img').val();
            $free = $('#is-free').val();
            $price = $('#facility-price').val();
            $remark = facility_ue.getContent();
            $.get('park/facility_add', {title: $name,facility_img:$img,free:$free,price:$price,remark:$remark}, function (data) {
                if(data == 'error'){
                    $.gritter.add({
                        title: '信息提示!',
                        text: '添加设备失败!'
                    });
                }else{
                    var $str = '<div class="checkbox"><label><input type="checkbox" name="facility[]" value="'+ data +'">'+$name+' </label></div>';
                    $('div.icheck').find('a.park-add-fac').before($str);
                    $('.close-facility').trigger('click');
                    $('#facility-name').val('');
                    $('#facility-pics-box').html('');
                }
            }, 'text');
        });
        /* 添加房源->添加小区*/
        $.get('plot/get_developer',{},function(data){
            var deve='';
            var developerArr = JSON.parse(data).data;
            for (var i=0;i<developerArr.length;i++){
                deve='<option value="'+developerArr[i].developer_id+'">'+developerArr[i].developer_name+'</option>';
                $("#deve").append(deve);
            }
        });
        $("#plot-submit").on('click', function (e) {
            e.preventDefault();
            $name = $('#plot-name').val();
            $developer = $('#deve option:selected').val();
            $video = $('#plot-video').val();
            $description = plot_ue.getContent();
            $.get('park/plot_add', {plot_name: $name,plot_deve:$developer,video:$video,description:$description}, function (data) {
                if(data == 'error'){
                    $.gritter.add({
                        title: '信息提示!',
                        text: '添加小区失败!'
                    });
                }else{
                    var $str = '<option value="'+data+'" selected>'+$name+'</option>';
                    $('#name').append($str);
                    $('.close-plot').trigger('click');
                    $('#plot-name').val('');
                    $('.plot-page').remove();
                    $.get('park/get_plot',{},function(rs_plot){
                        //console.log(rs_plot[0]);
                        for(var i=0;i<rs_plot.length;i++){
                            $("#my-tabs").append('<li order-status="'+i+'" class="plot-page"><a href="#plot'+i+'" class="plot-btn" data-toggle="tab" plot-id="'+rs_plot[i].plot_id+'">'+rs_plot[i].plot_name+'</a></li>');
                            $("#my-tab-pane").append('<div class="tab-pane" id="plot'+i+'"><div class="btn-group"><button id="btn-new" class="btn btn-primary" type="button">添加 <iclass="fa fa-plus"></i> </button> <button id="btn-del" class="btn btn-primary" type="button">删除 <iclass="fa fa-minus"></i> </button> <button id="btn-recommend"  class="btn btn-primary" type="button">推荐 <iclass="fa fa-thumbs-up"></i> </button> </div> <div class="adv-table"> <table id="plot'+i+'" class="table table-striped table-bordered plot-table" cellspacing="0" width="100%"> <thead> <tr> <th><input type="checkbox" id="check-all"/></th> <th>编号</th> <th>推荐</th> <th>名称</th> <th>位置</th> <th>价格</th> <th>操作</th> </tr> </thead> <tbody> </tbody> </table> </div> </div>');
                        }
                    },'json');
                }
//                console.log(data);
            }, 'text');
        });
    });
</script>

</body>
</html>
