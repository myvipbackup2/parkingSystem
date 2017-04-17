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
                留言管理
            </h3>
            <ul class="breadcrumb">
                <li>
                    <a href="#">首页</a>
                </li>
                <li>
                    <a href="#">系统管理</a>
                </li>
                <li class="active"> 留言管理</li>
            </ul>
        </div>
        <!-- page heading end-->

        <!--body wrapper start-->
        <div class="wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel">
                        <header class="panel-heading">
                            留言数据列表
                            <span class="tools pull-right">
                                <a href="javascript:;" class="fa fa-chevron-down"></a>
                             </span>
                        </header>
                        <div class="panel-body">
                            <div style="margin: 9px 0 5px;" class="btn-group">
                                <button id="btn-del" class="btn btn-primary" type="button">删除 <i class="fa fa-minus"></i></button>
                            </div>
                            <div class="adv-table">
                                <table id="example" class="table table-striped table-bordered" cellspacing="0"
                                       width="100%">
                                    <thead>
                                    <tr>
                                        <th>
                                            <input type="checkbox" id="check-all" />
                                        </th>
                                        <th>留言序号</th>
                                        <th>用户名</th>
                                        <th>留言内容</th>
                                        <th>留言时间</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody class="message-table">
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
<script id="message-tpl" type="text/html">
    <?php include 'tpls/message_tpl.html'; ?>
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
<script src="js/city.js"></script>


<!--common scripts for all pages-->
<script src="js/scripts.js"></script>

<script>
    $(function () {

        var table = $('#example').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "message/message_mgr",
            "columns": [
                null,
                {"data": "message_id", className: "clicked-cell"},
                {"data": "username", className: "clicked-cell"},
                {"data": null, className: "clicked-cell", render: function(data, type, row){
                    if( row.content.length > 30){
                        return row.content.substring(0, 30) + "...";
                    }
                    return row.content;
                }},
                {"data": "add_time", className: "clicked-cell"},
                null
            ],
            "columnDefs": [
                {
                    "orderable": false,
                    "targets": 0,
                    "render": function(data, type, row) {
                        return '<input type="checkbox" name="checklist" class="delete-message" value="' + row.message_id + '" />'
                    }
                },
                {"orderable": false, "targets": 2},
                {"orderable": false, "targets": 3},
                {
                    "orderable": false,
                    "targets": -1,
                    "data": null,
                    "render": function (data, type, row) {
                        return '<a href="javascript:;">回复</a> | <a href="javascript:;" class="btn-del" data-id="'+row.message_id+'">删除</a>';
                    },
                }
            ],

            "order": [[ 4, 'desc' ]]
        });

        //全选or反选
        $("#check-all").on("change",function(){
            if($(this).prop("checked")==true){
                $(".delete-message").prop("checked",true);
            }else{
                $(".delete-message").prop("checked",false);
            }
        });

        //批量删除
        $("#btn-del").on("click",function(){
            var str = "";
            $("tbody :checked").each(function(){
                str += this.value + ",";
            });
            str = str.slice(0,-1);
            $.get("message/delete_more_message",{messageId:str},function(data){
                if(data == "success"){
                    table.ajax.reload(null, true);//重新加载数据
                    $.gritter.add({
                        title: '信息提示!',
                        text: '删除成功!'
                    });
                }else{
                    $.gritter.add({
                        title: '信息提示!',
                        text: '删除失败，请刷新后重试!'
                    });
                }
            },"text");
        });

        $('#example tbody').on('click', '.btn-del', function () {
            if(confirm('是否删除该记录，删除后可以在回收站恢复!')){
                var dataId = $(this).data('id');
                console.log(dataId);
                $.get('message/message_del', {messageId: dataId}, function (data) {
                    if(data == 'success'){
                        table.ajax.reload(null,false);//重新加载数据
                        $.gritter.add({
                            title: '信息提示!',
                            text: '记录删除成功!'
                        });
                    }
                }, 'text');
            }
            return false;
        });


        $('#example tbody').css({cursor: 'pointer'}).on('click', '.clicked-cell', function () {
            var dataId = $(this).parent().data('id');
            console.log(dataId);
            $.sidepanel({
                width: 800,
                title: '留言详情',
                tpl: 'message-tpl',
                dataSource: 'message/get_message_detail',
                data: {
                    messageId: dataId
                },
                callback:function(){
                    //回复留言
                    if($("#answer-detail").val() != ""){
                        $("input[name=answer_message]").hide();
                        $("#answer-detail").hide();
                    }else{
                        $(".answer-detail").hide();
                    }

                    $("input[name=answer_message]").on("click",function(){
                        var id = -1;
                        var content=$("#answer-detail").val();
                        var receiverId =$("input[name=sender]").val();
                        var messageId = $("input[name=message_id]").val();
                        $.get("message/answer_message",{id:id,content:content,receiver:receiverId,reply_id :messageId} ,function(data){
                            if(data == 'success'){
                                $.gritter.add({
                                    title: '信息提示!',
                                    text: '留言添加成功!'
                                });
                                $("input[name=answer_message]").hide();
                            }
                        },'text');
                    });

                }
            });
        });


    });
</script>

</body>
</html>
