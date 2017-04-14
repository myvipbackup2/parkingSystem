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
    <title>确认订单</title>
    <base href="<?php echo site_url(); ?>">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/order.css">
    <script src="js/rem.js"></script>
</head>
<body>
<div class="container clearfix">
    <div class="order-success">
        <h2 class="order-title">订单提交成功</h2>
        <h2 class="order-title" style="font-size: .24rem;color: #36395c;">确认后，我们后发送短信通知您支付订金</h2>
    </div>

    <div class="hr"></div>

    <div class="order-info">
        <span>订单编号：<strong><?php echo $order_num; ?></strong></span>
    </div>

    <div class="hr"></div>

    <div class="order-name">
        <h2 class="order-title">预订人信息</h2>
        <div class="line clearfix">
            <span class="info-title fl">真实姓名：</span>
            <span class="info-content fr"><?php echo $realName ?></span>
        </div>
        <div class="line clearfix">
            <span class="info-title fl">手机号：</span>
            <span class="info-content fr"><?php echo $phone ?></span>
        </div>
    </div>

    <div class="hr"></div>

    <div class="cost-info">
        <h2 class="order-title">订单费用信息</h2>
        <div class="line clearfix  bold">
            <span class="info-title fl">房租</span>
        </div>
        <div class="line clearfix">
            <span class="info-title fl">日均价</span>
            <span class="info-content fr"><?php echo $price; ?></span>
        </div>
        <div class="line clearfix">
            <span class="info-title fl">天数</span>
            <span class="info-content fr"><?php echo $days; ?>天</span>
        </div>
        <div class="line clearfix">
            <span class="info-title fl">总价</span>
            <span class="info-content fr"><?php echo $price * $days; ?>元</span>
        </div>
    </div>

    <div class="hr"></div>

    <div class="cost-total">
        <div class="line clearfix">
            <span class="info-title fr">订单总金额：<i class="money">￥<?php echo $price * $days; ?>元</i></span>
        </div>
    </div>

    <div class="hr"></div>

    <div class="check-in-info">
        <h2 class="order-title">入住信息</h2>
        <div class="line clearfix">
            <span class="info-title fl">房源信息</span>
            <span class="info-content fr"><?php echo $houseInfo; ?></span>
        </div>
        <div class="line">
            <span class="info-content fr">一间</span>
            <span class="info-content fr" style="margin-right: .48rem">整租</span>
            <!--<span class="info-content fr"><?php /*echo $house ->bedroom */ ?>室</span>
            <span class="info-content fr" style="margin-right: .48rem"><?php /*echo $house ->livingroom */ ?>厅</span>
            <span class="info-content fr" style="margin-right: .48rem"><?php /*echo $house ->lavatory */ ?>卫</span>-->
        </div>
        <div class="line clearfix">
            <span class="info-title fl">入住信息</span>
            <span class="info-content fr"><?php echo $startTime; ?>入住</span>
        </div>
        <div class="line clearfix">
            <span class="info-content fr"><?php echo $endTime; ?>退房</span>
        </div>
        <div class="line clearfix">
            <span class="info-content fr">共<?php echo $days; ?>天</span>
        </div>
    </div>

    <div class="hr"></div>

    <a href="javascript:;" class="submit">确认支付</a>

    <a href="javascript:window.location.href='welcome/order';" class="back fl">返回</a>

</div>
<script>
    document.oncontextmenu = new Function("event.returnValue=false;");
    document.onselectstart = new Function("event.returnValue=false;");
</script>
<script src="js/zepto.js"></script>
<script src="js/header.js"></script>
<script>
    $(function () {
        var orderNo = '<?php echo $order_num; ?>';
        $('.submit').on('click', function () {
            window.location = 'wxpay/do_pay?orderNo=' + orderNo;
        });

    });
</script>
</body>
</html>