<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>消息中心</title>
    <base href="<?php echo site_url(); ?>"/>
    <script src="js/rem.js"></script>
    <link rel="stylesheet" href="css/reset.css"/>
    <link rel="stylesheet" href="css/message.css"/>
</head>
<body>
<div id="header">
    <a class="back" id="leftTopBtn" href="javascript:goBack()">&lt;&nbsp;悦居</a>
    <div class="title">
        消息中心
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
<div class="message-con">
    <?php
    if($result){ ?>
    <!--每条信息 start-->
        <?php
        foreach($result as $row){
            echo '<div class="message-item">';
            echo '<div class="fl msg-logo"><img src="images/msg-logo.png" alt=""/></div>';
            echo '<div class="fl msg-detail">';
            echo     '<div class="msg-title">';
            echo        '<h2>系统消息</h2>';
            echo        '<span class="fr msg-date">'.date("Y年m月d日",strtotime("$row->add_time")).'</span>';
            echo      '</div>';
            echo      '<div class="msg-info">'.$row->content.'</div>';
            echo   '</div>';
            echo '</div>';
        }
        ?>
    <?php }else{
        echo "<div class=\"no-message\">暂无评论</div>";
    }?>
</div>
<script src="js/zepto.js"></script>
<script src="js/header.js"></script>
</body>
</html>