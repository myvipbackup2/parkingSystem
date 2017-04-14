<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>评论</title>
    <base href="<?php echo site_url(); ?>"/>
    <script src="js/rem.js"></script>
    <link rel="stylesheet" href="css/reset.css"/>
    <link rel="stylesheet" href="css/collect.css"/>
    <link rel="stylesheet" href="css/webuploader.css">

</head>
<body>
<div id="header">
    <a class="back" id="leftTopBtn" href="javascript:goBack()">&lt;&nbsp;悦居</a>
    <div class="title">
        发表评价
    </div>
    <a href="javascript:;" class="menu-btn">
    </a>
    <div id="menu-top">
        <ul>
            <li class="menu-home">
                <i class="iconfont icon-home"></i>
                <a href="welcome/index" data-stat-label="首页">
                    首页
                </a>
            </li>
            <li class="menu-user">
                <i class="iconfont icon-about"></i>
                <a href="user"  data-stat-label="我的悦居">
                    我的悦居
                    <?php
                    $login_user = $this->session->userdata('userinfo');
                    if ($login_user) { ?>
                        (<em class="h-light">已登录</em>)
                    <?php } else { ?>
                        (<em class="h-light">未登录</em>)
                    <?php } ?>
                </a>
            </li>
            <li class="menu-favorites">
                <i class="iconfont icon-collect"></i><a href="welcome/collection_manage" data-stat-label="收藏">收藏</a>
            </li>
            <li class="menu-msg">
                <i class="iconfont icon-message"></i><a href="Welcome/message" data-stat-label="消息">消息</a>
                <span class="msg">&nbsp;</span>
            </li>
        </ul>
    </div>
</div>
<div class="pro-container">
    <div class="pro-item">
        <a class="pro-box clearfix">
            <div class="fl p-img">
                <img src="<?php echo $order->img_thumb_src?>" alt=""/>
            </div>
            <div class="fr p-info">
                <h2 class="p-title"><?php echo $order->title; ?></h2>
                <div class="p-style p-address">地址：<?php echo $order->city; ?>-<?php echo $order->region; ?>-<?php echo $order->street; ?></div>
                <div class="p-style p-type">
                    <span><?php echo $order->bedroom; ?>室</span>
                    <span>-</span>
                    <span><?php echo $order->livingroom; ?>厅</span>
                    <span>-</span>
                    <span><?php echo $order->lavatory; ?>卫</span>
                </div>
                <div class="p-date">
                    <div class="p-in-date">入住时间：<?php echo $order->start_time?> </div>
                    <div class="p-out-date">离开时间：<?php echo $order->end_time?></div>
                </div>
            </div>
        </a>
        <div class="pro-comment">
            <form action="order/add_comment">
                <input type="hidden" name="orderId" value="<?php echo $order->order_id?>">
<!--                --><?php //echo $result->houseId ?>
                <input type="hidden" name="houseId" value="<?php echo $order->house_id?>">
                <input type="hidden" name="score" value="" class="scoreHidden">
                <input type="hidden" name="cleanScore" value="" class="cleanHidden">
                <input type="hidden" name="trafficScore" value="" class="trafficHidden">
                <input type="hidden" name="manageScore" value="" class="manageHidden">
                <input type="hidden" name="facilityScore" value="" class="facilityHidden">

                <div class="pro-star clearfix" >
                    <span class="fl com-stars-title">整洁卫生：</span>
                    <ul class="com-stars cleanScore">
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul>
                </div>
                <div class="pro-star clearfix" >
                    <span class="fl com-stars-title">交通位置：</span>
                    <ul class="com-stars trafficScore" >
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul>
                </div>
                <div class="pro-star clearfix" >
                    <span class="fl com-stars-title">管理服务：</span>
                    <ul class="com-stars manageScore">
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul>
                </div>
                <div class="pro-star clearfix" >
                    <span class="fl com-stars-title">设施装修：</span>
                    <ul class="com-stars facilityScore">
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul>
                </div>
                <div class="pro-my-comment">
                    <div class="pro-com-title">
                        我的评论：
                    </div>
                    <div class="pro-com-area">
                        <textarea placeholder="我的评论是...." name="val"></textarea>
                    </div>
                </div>
                <div>
                    <div id="uploader-demo" class="clearfix">
                        <!--用来存放item-->
                        <div id="fileList" class="uploader-list"></div>
                        <div class="imgWrap">
                            <div id="filePicker"></div>
                        </div>
                    </div>
                    <img id="imgHeader" src="images/upload.png" alt="">
                </div>
                <div class="com-btns clearfix">
                    <input type="submit" class="com-update-btn" value="发布评论"/>
                </div>
            </form>

        </div>
    </div>
</div>
<script src="js/zepto.js"></script>
<script src="js/header.js"></script>
<script src="js/webuploader.custom.min.js"></script>

<script>
    //    头像上传功能
    $(function () {
        var $list = $('#fileList'),
//            存放图片的数组
            arr = [],
        // 优化retina, 在retina下这个值是2
            ratio = window.devicePixelRatio || 1,

        // 缩略图大小
            thumbnailWidth = 100 * ratio,
            thumbnailHeight = 100 * ratio,

        // Web Uploader实例
            uploader;

        // 初始化Web Uploader
        uploader = WebUploader.create({

            // 自动上传。
            auto: true,

            // swf文件路径
//            swf: BASE_URL + '/js/Uploader.swf',

            // 文件接收服务端。
            server: '<?php echo site_url(); ?>user/img_upload',

            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: '#filePicker',

            // 只允许选择文件，可选。
            accept: {
                title: 'Images',
                extensions: 'gif,jpg,jpeg,bmp,png',
                mimeTypes: 'image/*'
            }
        });

        // 当有文件添加进来的时候
        uploader.on('fileQueued', function (file) {

            var $li = $(
                    '<div id="' + file.id + '" class="file-item thumbnail">' +
                    '<img>' +
//                    '<div class="info">' + file.name + '</div>' +
                    '</div>'
                ),
                $img = $li.find('img');

            $list.append($li);

//            $('#imgHeader').remove();
//            $list.html($li); //替换原来上传的头像

            // 创建缩略图
            uploader.makeThumb(file, function (error, src) {
                if (error) {
                    $img.replaceWith('<span>预览出错</span>');
                    return;
                }
                $img.attr('src', src);
            }, thumbnailWidth, thumbnailHeight);
        });

        // 文件上传过程中创建进度条实时显示。
        uploader.on('uploadProgress', function (file, percentage) {
            var $li = $('#' + file.id),
                $percent = $li.find('.progress span');

            // 避免重复创建
            if (!$percent.length) {
                $percent = $('<p class="progress"><span></span></p>')
                    .appendTo($li)
                    .find('span');
            }

            $percent.css('width', percentage * 100 + '%');
        });

        // 文件上传成功，给item添加成功class, 用样式标记上传成功。
        uploader.on('uploadSuccess', function (file, response) {
            $('form').prepend('<input type="hidden" name="imgs[]" value="'+response.pic+'">');


//            vm.headImg = imgurl;
            $('#' + file.id).addClass('upload-state-done');
        });

        // 文件上传失败，现实上传出错。
        uploader.on('uploadError', function (file) {
            var $li = $('#' + file.id),
                $error = $li.find('div.error');

            // 避免重复创建
            if (!$error.length) {
                $error = $('<div class="error"></div>').appendTo($li);
            }

            $error.text('上传失败');
        });

        // 完成上传完了，成功或者失败，先删除进度条。
        uploader.on('uploadComplete', function (file) {
            $('#' + file.id).find('.progress').remove();
        });
    });
    $('.com-stars li').on('click',function(){
//        $(this).prevAll().addClass('active');
        var $index = $(this).index()+1;
        $(this).parent().find('li').removeClass('active');
        $(this).parent().find('li').each(function(index,elem){
            if(index < $index){
                $(elem).addClass('active');
            }
        });

        $('.cleanHidden').val($('.cleanScore li.active').length);
        $('.trafficHidden').val($('.trafficScore li.active').length);
        $('.manageHidden').val($('.manageScore li.active').length);
        $('.facilityHidden').val($('.facilityScore li.active').length);
        $('.scoreHidden').val($('.com-stars li.active').length/20*5);

    });
</script>

</body>
</html>