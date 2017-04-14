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
    <base href="<?php echo site_url(); ?>">
    <link rel="stylesheet" href="css/wepay.css">
    <title>微信支付页面</title>
    <script type="text/javascript">
        //调用微信JS api 支付
        function jsApiCall() {
            WeixinJSBridge.invoke(
                'getBrandWCPayRequest',
                <?php echo $jsApiParameters; ?>,
                function (res) {
                    WeixinJSBridge.log(res.err_msg);
                    if (res.err_msg == "get_brand_wcpay_request:ok") {
                        window.location = 'wxpay/pay_success?orderNo=<?php echo $orderno; ?>';
                    } else {
                        alert('支付失败!');
                    }
                }
            );
        }

        function callpay() {
            if (typeof WeixinJSBridge == "undefined") {
                if (document.addEventListener) {
                    document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
                } else if (document.attachEvent) {
                    document.attachEvent('WeixinJSBridgeReady', jsApiCall);
                    document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
                }
            } else {
                jsApiCall();
            }
        }
    </script>
</head>
<body>

<!---------------------------->
<div class="header">
    <div class="all_w">
        <div class="gofh"><a href="#"><img src="images/wx-back.jpg"></a></div>
        <div class="ttwenz">
            <h4>确认交易</h4>
            <h5>微信安全支付</h5>
        </div>
    </div>
</div>
<div class="wenx_xx">
    <div class="mz">悦居租房</div>
    <div class="mz">订单编号:<?php echo $orderno; ?></div>
    <div class="wxzf_price">￥<?php echo $fee; ?></div>
</div>
<div class="skf_xinf">
    <div class="all_w"><span class="bt">收款方</span> <span class="fr">哈尔滨悦居租房</span></div>
</div>
<button onclick="callpay()" class="ljzf_but all_w">立即支付</button>
</body>
</html>