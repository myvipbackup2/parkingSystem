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
    <title>订单提交页</title>
    <base href="<?php echo site_url(); ?>">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/mint-ui.min.css">
    <link rel="stylesheet" href="css/order.css">
    <script src="js/rem.js"></script>
</head>
<body>
<div id="app">
    <mt-header title="订单信息">
        <mt-button @click="goBack" icon="back" slot="left">返回</mt-button>
    </mt-header>
    <div class="container">

        <div class="check-in">
            <h2 class="order-title">入住信息</h2>
            <div class="line clearfix">
                <span class="info-title fl">房源信息：</span>
                <span class="info-content fr"
                      style="width: 75%;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;text-align: right;">
                    <?php echo $title; ?>
                </span>
            </div>
            <div class="line clearfix">
                <span class="info-title fl">入住时间：</span>
                <span class="info-content fr"><?php echo $startTime; ?></span>
            </div>
            <div class="line clearfix">
                <span class="info-title fl">退房时间：</span>
                <span class="info-content fr"><?php echo $endTime; ?></span>
            </div>
        </div>

        <div class="hr"></div>

        <div class="order-name">
            <h2 class="order-title">预订人信息</h2>
            <mt-field label="真实姓名:" placeholder="请输入真实姓名" :attr="{ maxlength: 6 }" :state="nameState"
                      v-model="name"></mt-field>
            <mt-field label="手机号:" placeholder="请输入手机号" type="tel" :attr="{ maxlength: 11 }" :state="telState"
                      v-model="tel"></mt-field>
        </div>

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
        </div>

        <div class="hr"></div>

        <div class="cost-total">
            <div class="line clearfix">
                <span class="info-title fr">订单总金额：<i class="money">￥<?php echo $price * $days; ?>元</i></span>
            </div>
        </div>

        <div class="hr"></div>

        <div class="unsubscribe-role clearfix">
            <h2 class="order-title">退订规则</h2>
            <div class="line p clearfix">
                <p class="info-content fl">{{rule}}</p>
            </div>
            <div class="checkbox clearfix">
                <div class="cbox fl" :class="{checked:isCheck}" role="checkbox" @click="isCheck=!isCheck">
                </div>
                <a class="fl" @click="showProtocol" href="javascript:;">我已阅读并同意网站协议</a>
            </div>

            <a href="javascript:;" @click="check" class="submit" role="button">提交订单</a>

            <a href="javascript:window.history.go(-1)" class="back fl">返回</a>

        </div>

        <!--错误弹层-->
        <div class="mint-msgbox-wrapper" style="position: absolute; z-index: 1000;">
            <div class="mint-msgbox" v-show="msgShow" style="display:none;">
                <div class="mint-msgbox-header">
                    <div class="mint-msgbox-title">{{errTitle}}</div>
                </div>
                <div class="mint-msgbox-content">
                    <div class="mint-msgbox-message">
                        {{errMsg}}
                        <mt-spinner v-show="spinnerShow" type="snake" color="#ff4081" :size="30"></mt-spinner>
                    </div>
                </div>
                <div class="mint-msgbox-btns" v-show="btnShow">
                    <button @click="closeMsg" class="mint-msgbox-btn mint-msgbox-confirm ">确定</button>
                </div>
            </div>
        </div>
        <div class="v-modal" v-show="modalShow" style="z-index: 999;display: none;"></div>

    </div>
</div>
<script>
    document.oncontextmenu = new Function("event.returnValue=false;");
    document.onselectstart = new Function("event.returnValue=false;");
</script>
<script src="js/vue.min.js"></script>
<script src="js/mintUI.min.js"></script>
<script>
    new Vue({
        el: '#app',
        data: {
            isCheck: true,
            msgShow: false,
            modalShow: false,
            spinnerShow: false,
            btnShow: false,
            errTitle: '提示',
            errMsg: '请勾选网站协议!',
            name: '',
            tel: '',
            rule: '退订规则规则退订规则规则退订规则规则退订规则规则退订规则规则退订规则规则退订规则规则'
        },
        methods: {
            check: function () {
                if (!this.isCheck) {
                    this.errTitle = '提交失败';
                    this.errMsg = '请先勾选网站协议!';
                    this.showMsg();
                } else if (!this.checkMobile()) {
                    this.errTitle = '手机号错误';
                    this.errMsg = '请填写正确手机号！';
                    this.showMsg();
                } else if (this.name === '') {
                    this.errTitle = '姓名未填写';
                    this.errMsg = '请填写真实姓名！';
                    this.showMsg();
                } else {
                    this.errTitle = '订单提交中';
                    this.errMsg = '';
                    this.showMsg();
                    this.spinnerShow = true;
                    this.btnShow = false;
                    this.post('order/confirm_order', {
                        'startDate': '<?php echo $startTime; ?>',
                        'endDate': '<?php echo $endTime; ?>',
                        'houseId': <?php echo $house->house_id?>,
                        'name': this.name,
                        'tel': this.telNum
                    })
                }
            },
            closeMsg: function () {
                this.msgShow = false;
                this.modalShow = false;
            },
            showMsg: function () {
                this.msgShow = true;
                this.modalShow = true;
                this.btnShow = true;
                this.spinnerShow = false;
            },
            checkMobile: function () {  //正则验证手机号
                if (!(/^1(3|4|5|7|8)[0-9]\d{8}$/.test(this.telNum))) {
                    return false;
                }
                return true;
            },
            checkName: function () {  //人名正则，可以中文可以英文但是不可混
                if (!(/^([\u4e00-\u9fa5]{1,10}|[a-zA-Z\.\s]{1,10})$/.test(this.name))) {
                    return false;
                }
                return true;
            },
            showProtocol: function () {  //显示网站协议，并且自动打勾
                this.errTitle = '协议内容';
                this.errMsg = '网站协议网站协议网站协议网站协议网站协议网站协议网站协议网站协议网站协议网站协议网站协议网站协议';
                this.msgShow = true;
                this.modalShow = true;
                this.btnShow = true;
                this.isCheck = true;
            },
            post: function (URL, PARAMS) {  //自己封装的post方法
                var temp = document.createElement("form");
                temp.action = URL;
                temp.method = "post";
                temp.style.display = "none";
                for (var x in PARAMS) {
                    var opt = document.createElement("textarea");
                    opt.name = x;
                    opt.value = PARAMS[x];
                    temp.appendChild(opt);
                }
                document.body.appendChild(temp);
                temp.submit();
                return temp;
            },
            goBack: function () {
                window.history.go(-1);
            }
        },
        computed: {
            telNum: function () {  //手机号number类型
                return parseInt(this.tel);
            },
            nameState: function () {
                if (this.name === '') {
                    return 'warning';
                } else if (!this.checkName()) {
                    return 'error';
                }
                return 'success';
            },
            telState: function () {
                if (this.tel === '') {
                    return 'warning';
                } else if (!this.checkMobile()) {
                    return 'error';
                }
                return 'success';
            }
        }
    });
</script>
</body>
</html>