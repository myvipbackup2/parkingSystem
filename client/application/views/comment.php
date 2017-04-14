<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>我的评论</title>
    <base href="<?php echo site_url(); ?>"/>

    <script src="js/rem.js"></script>
    <link rel="stylesheet" href="css/reset.css"/>
    <link rel="stylesheet" href="css/collect.css"/>
</head>
<body>
<div id="header">
    <a class="back" id="leftTopBtn" href="javascript:goBack()">&lt;&nbsp;悦居</a>
    <div class="title">
        我的评论
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
    <?php foreach ($page as $comment){?>
    <div class="pro-item">
        <a class="pro-box clearfix">
            <div class="fl p-img">
                <img src="<?php echo $comment->img_thumb_src?>" alt=""/>
            </div>
            <div class="fr p-info">
                <h2 class="p-title"><?php echo $comment->title?></h2>
                <div class="p-style p-address">地址：<?php echo $comment->city.$comment->region.$comment->street?></div>
                <div class="p-style p-type">
                    <?php echo $comment->bedroom."居".$comment->livingroom."室".$comment->lavatory."卫"?>
                </div>
                <div class="p-date">
                    <div class="p-in-date">入住时间：<?php echo date("Y年m月d日",strtotime("$comment->start_time"))?> </div>
                    <div class="p-out-date">离开时间：<?php echo date("Y年m月d日",strtotime("$comment->end_time"))?></div>
                </div>
            </div>
        </a>
        <div class="pro-comment">
            <div class="pro-star clearfix" >
                <span class="fl com-stars-title">评论星级：</span>
                <ul class="com-stars">
                    <li class="<?php echo $comment->score/20 >= 1?'active':''?>"></li>
                    <li class="<?php echo $comment->score/20 >= 2?'active':''?>"></li>
                    <li class="<?php echo $comment->score/20 >= 3?'active':''?>"></li>
                    <li class="<?php echo $comment->score/20 >= 4?'active':''?>"></li>
                    <li class="<?php echo $comment->score/20 == 5?'active':''?>"></li>
                </ul>
            </div>
            <div class="pro-my-comment">
                <div class="pro-com-title">
                    我的评论：
                </div>
                <div class="pro-com-area">
                    <?php echo $comment->content?>
<!--                    <textarea placeholder="--><?php //echo $comment->content?><!--"></textarea>-->
                </div>
            </div>
            <!--<div class="com-btns clearfix">
                <a href="#" class="com-del-btn">删除评论</a>
                <a href="#" class="com-update-btn">修改评论</a>
            </div>-->
        </div>
    </div>
    <?php }?>
</div>

<script src="js/zepto.js"></script>
<script src="js/header.js"></script>

</body>
</html>