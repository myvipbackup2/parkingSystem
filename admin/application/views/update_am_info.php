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
    <link rel="stylesheet" href="css/admin_update.css">
    <!--icheck-->
    <link href="js/iCheck/skins/minimal/minimal.css" rel="stylesheet">
    <link href="js/iCheck/skins/minimal/red.css" rel="stylesheet">

    <!--gritter-->
    <link href="js/gritter/css/jquery.gritter.css" rel="stylesheet"/>

    <link href="css/style.css" rel="stylesheet">
      <style>

      </style>
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
    <div class="main-content ">

        <!-- header section start-->
        <?php include 'header.php'; ?>
        <!-- header section end-->

        <!-- page heading start-->
        <div class="page-heading">
            <h3>
                修改管理员信息
            </h3>
        </div>
        <!-- page heading end-->
        <!--body wrapper start-->
        <div class=" wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel">
                        <header class="panel-heading">
                            请按表单输入管理员信息
                        </header>
                        <div class="panel-body">
                            <form id="admin_form" role="form" action="Admin/update_info" method="post"  enctype="multipart/form-data">

                                    <div class="image ">
                                        <a href="#" class="btn  dropdown-toggle" data-toggle="dropdown">
                                            <img src="<?php echo  $this->session->userdata('admininfo')->img_src;?>"  class="head_img first" />
                                            <img src="" class="head_img second" alt="" id="preview">
                                        </a>
                                    </div>
                                    <div class="btn" >
                                        <input type="file" class="file_upload"  style="display: none" name="img" >
                                        <button type="button" class="btn btn-default" value="选择头像上传..." id="image">选择头像上传...</button>
                                    </div>

                                <div class="form-group form ">
                                    <label for="adminname" class="col-sm-2 clearpaddingleft font">管理员名</label>
                                    <div class="col-sm-10 " >
                                        <input type="text" class="form-control input col-sm-6 " id="admin_name" value="<?php echo  $this->session->userdata('admininfo')->name;?>"  name="name" disabled= " " >
                                    </div>
                                </div>
                                <div class="form-group form">
                                    <label for="old_pass" class="col-sm-2 clearpaddingleft font">输入旧密码</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control input col-sm-6" id="old_pass" placeholder="输入旧密码" name="old_pass"><span class="tip1 font col-sm-4" style="color: red;"></span>
                                    </div>
                                </div>
                                <div class="form-group form">
                                    <label for="new_pass" class="col-sm-2 clearpaddingleft font">新密码</label>
                                    <div class="col-sm-10 ">
                                        <input type="password" class="form-control input col-sm-6" id="new_pass" style="background-color:#eee" placeholder="输入新密码" name="new_pass"><span class="tip2 font col-sm-4 "  style="color: red;"></span>
                                    </div>
                                </div>
                                <div class="form-group form">
                                    <label for="real_pass" class="col-sm-2 clearpaddingleft font">确认密码</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control input col-sm-6" id="rea_pass" placeholder="重新输入新密码" name="real_pass"><span class="tip3 font col-sm-4" style="color: red;"></span>
                                    </div>
                                </div>
                                <br/>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <input id="admin_edit_sub" type="submit" value="提交更新信息" class="btn btn-primary" name="chpwd">
                                    </div>
                                </div>
                        </div>
                            </form>
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
<!-- Placed js at the end of the document so the pages load faster -->
<script src="js/jquery-1.12.4.min.js"></script>
<script src="js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="js/jquery-migrate-1.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/modernizr.min.js"></script>
<script src="js/jquery.nicescroll.js"></script>

<script src="js/jquery.sidepanel.js"></script>

<!--common scripts for all pages-->
<script type="text/javascript">
    $(function(){
        $("#image").on('click',function(){
            $('.file_upload').click();
        });

        $(".file_upload").change(function() {
            $(".second").show().siblings().hide();

            var $file = $(this);
            var fileObj = $file[0];
            var windowURL = window.URL || window.webkitURL;
            var dataURL;
            var $img = $("#preview");

            if(fileObj && fileObj.files && fileObj.files[0]){
                dataURL = windowURL.createObjectURL(fileObj.files[0]);
                console.log(dataURL)
                $img.attr('src',dataURL);
            }else{
                dataURL = $file.val();
                var imgObj = document.getElementById("preview");
                imgObj.style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale)";
                imgObj.filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = dataURL;

            }
        });

        $pwd = $('input[name=old_pass]');
        $newpwd = $('input[name=new_pass]');
        $realpwd=$('input[name=real_pass]');
        $tip3=$('.tip3');
        $tip1=$('.tip1');
        $tip2=$('.tip2');
        $btn = $('input[name=chpwd]');

        if($pwd.val()=='') {
            $newpwd.attr('disabled',true);
            $realpwd.attr('disabled',true);
        }else {
            $newpwd.removeAttr('disabled');
            $realpwd.removeAttr('disabled');
        }
        $pwd.on('blur',function(){
            $.get("Admin/query_info",{
                "password":$pwd.val()
            },function(row){
                if(row=='success'){
                    $tip1.html("旧密码输入成功");
                    $newpwd.removeAttr('disabled');
                    $realpwd.removeAttr('disabled');
                }else{
                    $tip1.html('输入密码与旧密码不一致');
                    $newpwd.attr('disabled',true);
                    $realpwd.attr('disabled',true);
                    $btn.attr('disabled',true)
                }
            },"text")
        });

        $newpwd.on('blur',function(){
            $.get("Admin/query_info",{
                "password":$newpwd.val()
            },function(row){
                if(row =='success'){
                    $tip2.html("新密码不能与旧密码一致");
                    $btn.attr('disabled',true)
                }else if($newpwd.val().length<4 ){
                    $tip2.html('新密码不能小于4位');
                    $realpwd.attr('disabled',true);
                    $btn.attr('disabled',true);
                }else{
                    $tip2.html('新密码可以使用');
                    $realpwd.removeAttr('disabled');
                    $btn.removeAttr('disabled');
                }
            },"text")
        });
        $realpwd.on('blur',function(){
            if($newpwd.val()==$realpwd.val()){
                $tip3.html('再次输入新密码成功');
                $btn.removeAttr('disabled');
            }else{
                $tip3.html('输入密码与新密码不一致');
                $btn.attr('disabled',true);
            }
        });

    });
</script>
</body>
</html>
