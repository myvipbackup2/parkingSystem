<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'meta.php'; ?>

    <title>随心停后台管理系统 - 设备管理</title>

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
                设备管理
            </h3>
            <ul class="breadcrumb">
                <li>
                    <a href="#">首页</a>
                </li>
                <li>
                    <a href="<?php echo site_url('facility') ?>">设备管理</a>
                </li>
                <li class="active"> 设备管理</li>
            </ul>
        </div>
        <!-- page heading end-->

        <!--body wrapper start-->
        <div class="wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel">
                        <header class="panel-heading">
                            设备管理列表
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
                                        <th>编号</th>
                                        <th>设备名称</th>
                                        <th>设备图标</th>
                                        <th>是否付费</th>
                                        <th>价格</th>
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

<!-- templates -->
<script id="new-user-tpl" type="text/html">

    <?php include 'tpls/new_facility_tpl.html' ?>
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
            var blogobj = [];
            for (var i = 0; i < blogs.length; i++) {
                //console.log(blogs[i].value);
                if (blogs[i].checked == true) {
                    blogobj.push(blogs[i].value);
                }
            }
            if(blogobj.length == 0){
                $.gritter.add({
                    title: '信息提示!',
                    text: '请选择要删除的记录!'
                });
            }else{
                $.post('facility/del_all', {'name': blogobj}, function (data) {
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

            }

        });

        $('#example tbody').on('click', '.btn-del', function () {
            if (confirm('是否删除该记录，删除后可以在回收站恢复!')) {
                var dataId = $(this).data('id');
                //alert(dataId);
                $.get('facility/facility_del', {facilityId: dataId}, function (data) {
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
            "ajax": "facility/facility_mgr",
            "columns": [
                {
                    "width": "16px",
                    "data": null,
                    "render": function (data, type, row) {
                        return '<input type="checkbox" name="del[]" class="select_check" value="' + row.type_id + '">';
                    },
                },
                {"data": "type_id", "width": "30px", "className": "text-center"},
                {"data": "name"},
                {
                    "targets": 3,
                    "data": null,
                    "render": function (data, type, row) {
                        return '<img src="' + row.icon + '" alt="">';
                    }
                },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        if(row.is_free == 0){
                            return "免费";
                        }else{
                            return "付费";
                        }
                    }
                },
                {"data": "price"},
                {
                    "targets": -1,
                    "data": null,
                    "render": function (data, type, row) {
                        return '<a href="javascript:;" class="btn-del" data-id="' + row.type_id + '">删除</a>';
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
                title: '添加新设备',
                tpl: 'new-user-tpl',
                // tpl:'new-facility-tpl',
                callback: function () {
                    //处理付费多选框
                    $('#is-free').on('change',function(){
                        var $checked = $(this).prop('checked');
                        var $formGroup = $(this).parents('div.form-group').next('div.form-group');
                        if($checked){
                            var str ='<label for="price" class="col-lg-2 col-sm-2 control-label">价格</label>' +
                                '<div class="col-lg-8">' +
                                '<input type="text" id="price" name="price" class="form-control">' +
                                '</div>';
                            $formGroup.html(str);
                        }else{
                            $formGroup.html("");
                        }
                    });
                    //实例化编辑器
                    UE.delEditor('new-container');
                    var ue = UE.getEditor('new-container');

                    //图片上传代码开始
                    var uploader = new plupload.Uploader({ //创建实例的构造方法
                        runtimes: 'html5,flash,silverlight,html4', //上传插件初始化选用那种方式的优先级顺序
                        browse_button: 'btn', // 上传按钮
                        url: "facility_upload", //远程上传地址
                        filters: {
                            max_file_size: '500kb', //最大上传文件大小（格式100b, 10kb, 10mb, 1gb）
                            mime_types: [ //允许文件上传类型
                                {
                                    title: "files",
                                    extensions: "jpg,png,gif,ico"
                                }
                            ]
                        },
                        multi_selection: false, //true:ctrl多文件上传, false 单文件上传
                        resize: {
                            width: 100,
                            height: 100
                        },
                        init: {
                            FilesAdded: function (up, files) { //文件上传前
                                if ($("#ul_pics").children("li").length > 30) {
                                    alert("您上传的图片太多了！");
                                    uploader.destroy();
                                } else {
                                    var li = '';
                                    plupload.each(files, function (file) { //遍历文件
                                        li += "<li id='" + file['id'] + "'><div class='progress'><span class='bar'></span><span class='percent'>0%</span></div></li>";
                                    });
                                    $("#ul_pics").append(li);
                                    uploader.start();
                                }
                            },
                            UploadProgress: function (up, file) { //上传中，显示进度条
                                var percent = file.percent;
                                $("#" + file.id).find('.bar').css({
                                    "width": percent + "%"
                                });
                                $("#" + file.id).find(".percent").text(percent + "%");
                            },
                            FileUploaded: function (up, file, info) { //文件上传成功的时候触发
                                var data = eval("(" + info.response + ")");
                                $("#" + file.id).html("<div class='img'><img src='" + data.pic + "'/><a id='del-img' class='upload-del-btn'></a></div><p>" + data.name + "<input type='hidden' name='upload_img[]' value='" + data.pic + "'></p>");
                            },
                            Error: function (up, err) { //上传出错的时候触发
                                alert(err.message);
                            }
                        }
                    });
                    uploader.init();
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
