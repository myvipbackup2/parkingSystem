<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="keywords" content="悦居租房"/>
    <meta name="description" content="悦居租房"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name='apple-touch-fullscreen' content='yes'>
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <meta name="format-detection" content="address=no">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>订单详情</title>
    <base href="<?php echo site_url(); ?>">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/order.css">
    <script src="js/rem.js"></script>
</head>
<body>
<div id="header">
    <a class="back" id="leftTopBtn" href="javascript:goBack()">&lt;&nbsp;悦居</a>
    <div class="title">
        订单详情
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
<div class="container clearfix">
    <div class="order-name">
        <h2 class="order-title">预订人信息</h2>
        <div class="line clearfix">
            <span class="info-title fl">真实姓名：</span>
            <span class="info-content fr"><?php echo $order->invoice_person_name?></span>
        </div>
        <div class="line clearfix">
            <span class="info-title fl">手机号：</span>
            <span class="info-content fr"><?php echo $order->invoice_person_tel?></span>
        </div>
        <div class="line clearfix">
            <span class="info-title fl">紧急联系人：</span>
            <span class="info-content fr"><?php echo $order->urgency_contact_tel?></span>
        </div>
    </div>

    <div class="hr"></div>
    <div class="check-in-info">
        <h2 class="order-title">入住信息</h2>
        <div class="line clearfix">
            <span class="info-title fl">房源信息</span>
            <span class="info-content fr"><?php echo $order->city.$order->region.$order->street?></span>
        </div>
        <div class="line">
            <span class="info-content fr"><?php echo $order->bedroom?>室</span>
            <span class="info-content fr" style="margin-right: .48rem"><?php echo $order->livingroom?>厅</span>
            <span class="info-content fr" style="margin-right: .48rem"><?php echo $order->lavatory?>卫</span>
        </div>
        <div class="line clearfix">
            <span class="info-title fl">入住信息</span>
            <span class="info-content fr"><?php echo $order->start_time?>-12:00入住</span>
        </div>
        <div class="line clearfix">
            <span class="info-content fr"><?php echo $order->end_time?>-12:00退房</span>
        </div>
    </div>
    <div class="hr"></div>
    <div class="cost-total">
        <div class="line clearfix">
            <span class="info-title fr">订单总金额：<i class="money">￥<?php echo $order->price?>元</i></span>
        </div>
    </div>
    
</div>
<script src="js/zepto.js"></script>
<script src="js/header.js"></script>
<script>
    document.oncontextmenu = new Function("event.returnValue=false;");
    document.onselectstart = new Function("event.returnValue=false;");
</script>
</body>
</html>