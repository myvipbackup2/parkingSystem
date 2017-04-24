<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="keywords" content="孟昊阳20134200"/>
    <meta name="description" content="孟昊阳20134200"/>
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
            <span class="info-title fl">费用</span>
        </div>
        <div class="line clearfix">
            <span class="info-title fl">每小时均价</span>
            <span class="info-content fr"><?php echo $price; ?></span>
        </div>
        <div class="line clearfix">
            <span class="info-title fl">小时</span>
            <span class="info-content fr"><?php echo $days; ?>小时</span>
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
        <h2 class="order-title">停车信息</h2>
        <div class="line clearfix">
            <span class="info-title fl">车位信息</span>
            <span class="info-content fr"><?php echo $parkInfo; ?></span>
        </div>
        <div class="line">
            <span class="info-content fr">一字型停车位</span>
        </div>
        <div class="line clearfix">
            <span class="info-title fl">停车信息</span>
            <span class="info-content fr"><?php echo $startTime; ?>时停车</span>
        </div>
        <div class="line clearfix">
            <span class="info-content fr"><?php echo $endTime; ?>时离开</span>
        </div>
        <div class="line clearfix">
            <span class="info-title fl">剩余停车时间</span>
            <span class="info-content fr" id="t_s">00秒</span>
            <span class="info-content fr" id="t_h">00时</span>
            <span class="info-content fr" id="t_m">00分</span>
            <span class="info-content fr" id="t_d">00天</span>
        </div>
        <div class="line clearfix">
            <span class="info-content fr"></span>
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
<script src="js/vue.min.js"></script>
<script src="js/axios.min.js"></script>
<script>
    $(function () {
        var orderNo = '<?php echo $order_num; ?>';
        $('.submit').on('click', function () {
            window.location = 'wxpay/do_pay?orderNo=' + orderNo;
        });

    });
</script>
<script>

    function formatTen(num) {
        return num > 9 ? (num + "") : ("0" + num);
    }

    function GetRTime(){

        var orderDate = new Date('<?php echo $endTime.':00:00'; ?>'.replace(/-/g, "/")); //字符串转成时间戳
        var oDate = new Date();
        var y = oDate.getFullYear();
        var M = oDate.getMonth() + 1;
        var p = oDate.getDate();
        var x = oDate.getHours();
        var minute = oDate.getMinutes();
        var second = oDate.getSeconds();
        var e = y + '-' + formatTen(M) + '-' + formatTen(p) + ' ' + formatTen(x) + ':' +formatTen(minute) + ':' + formatTen(second);
        var NowTime  = (e.replace(/-/g, "/"));
        NowTime = new Date(NowTime);
        var t =orderDate.getTime() - NowTime.getTime();
        var d=Math.floor(t/1000/60/60/24);
        var h=Math.floor(t/1000/60/60%24);
        var m=Math.floor(t/1000/60%60);
        var s=Math.floor(t/1000%60);

        document.getElementById("t_d").innerHTML = d + "天";
        document.getElementById("t_h").innerHTML = h + "时";
        document.getElementById("t_m").innerHTML = m + "分";
        document.getElementById("t_s").innerHTML = s + "秒";

//        如果预定时间跟当前时间一直清除定时器
        if(NowTime==orderDate){
            clearInterval(timer);
            document.getElementById("t_d").innerHTML = 0 + "天";
            document.getElementById("t_h").innerHTML = 0 + "时";
            document.getElementById("t_m").innerHTML = 0 + "分";
            document.getElementById("t_s").innerHTML = 0 + "秒";
            var params = new URLSearchParams();
            params.append('orderNo', <?php echo $order_num; ?>);
            axios.post('wxpay/order_finished', params).catch(function (error) {
                console.log(error);
            });
        }
    }
    timer=setInterval(GetRTime,1000);


</script>
</body>
</html>