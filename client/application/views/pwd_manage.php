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
    <title>修改密码</title>
    <base href="<?php echo site_url(); ?>"/>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/resetPass.css">
    <link rel="stylesheet" href="css/mint-ui.min.css">
    <script src="js/rem.js"></script>
</head>
<body>
<div id="header">
    <a class="back" id="leftTopBtn" href="javascript:goBack()">&lt;&nbsp;悦居</a>
    <div class="title">
        修改密码
    </div>
    <a href="javascript:;" class="menu-btn">
    </a>
    <div id="menu-top">
        <ul>
            <li class="menu-home">
                <i class="iconfont icon-home"></i>
                <a href="welcome/index" data-stat-label="首页">
                    修改密码
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
<div id="app">
    <div class="check">
        <span class="title">已验证手机号：</span>
        <span class="phone"><?php echo $user->tel?></span>
    </div>
        <div class="reset reset-phone-code">
            <h4>手机验证码:</h4>
            <div class="reset-box clearfix">
                <input class="reset-input reset-phone-code-num fl" type="text" placeholder="请输入手机验证码..." v-model="phoneCode">
                <input class="reset-btn reset-phone-code-btn fr" :style="{background:backColor}" type="button" v-model="phoneMsg" @click="sendCode">
            </div>
        </div>
        <div class="reset reset-phone clearfix">
            <h4>请输入新密码:</h4>
            <input class="reset-input reset-phone-num fl" type="password" placeholder="请输入新密码..." v-model="password">
        </div>
        <div class="reset reset-code">
            <h4>验证码:</h4>
            <div class="reset-box clearfix">
                <input class="reset-input reset-phone-code-num fl" type="text" placeholder="请输入验证码..." v-model="captchaVal">
                <a href="javascript:;"
                   class="captcha login-btn login-phone-code-btn login-code-img fr" title="看不清？换一张！">
                    <?php echo $image; ?>
                </a>
            </div>
        </div>
        <div class="reset-submit">
            <input type="submit" value="修改" @click="editPassword">
        </div>
    <div class="mint-msgbox-wrapper" style="position: absolute; z-index: 1001;" v-show="isAlert">
        <div class="mint-msgbox">
            <div class="mint-msgbox-header">
                <div class="mint-msgbox-title">提示</div>
            </div>
            <div class="mint-msgbox-content">
                <div class="mint-msgbox-message">{{data}}</div>
                <div class="mint-msgbox-input" style="display: none;">
                    <input placeholder="" type="text">
                    <div class="mint-msgbox-errormsg" style="visibility: hidden;"></div>
                </div>
            </div>
            <div class="mint-msgbox-btns">
                <button class="mint-msgbox-btn mint-msgbox-cancel " style="display: none;">取消</button>
                <button class="mint-msgbox-btn mint-msgbox-confirm " @click="hideAlert()">确定</button>
            </div>
        </div>
    </div>
    <div class="v-modal" style="z-index: 1000;" v-show="isAlert"></div>
</div>
<script src="js/vue.min.js"></script>
<script src="js/axios.min.js"></script>
<script src="js/mintUI.min.js"></script>
<script src="js/zepto.js"></script>
<script src="js/header.js"></script>
<script>
    var vm = new Vue({
        el: '#app',
        data: {
            isAlert:false,
            password:'',
            captchaVal:'',
            data:'',
            flag:true,
            phone:'<?php echo $user->tel?>',
            phoneCode:'',
            phoneMsg:'获取验证码',
            backColor:'',
            userId:<?php echo $user->user_id?>
        },
        methods: {
            //修改信息
            editPassword:function(){
                var _this = this;
                var params = new URLSearchParams();
                params.append('captchaVal',_this.captchaVal);
                params.append('password',_this.password);
                params.append('phoneCode',_this.phoneCode);
                params.append('userId',_this.userId);
                axios.post('welcome/update_password', params).then(function (res) {
//                        console.log(data);
                    if (res.data == 'success') {
                        _this.isAlert = true;
                        _this.data = "修改成功";
                        window.location.href = "welcome/personalInfo";
                    } else {
                        _this.isAlert = true;
                        _this.data = res.data;
                    }
                });
                return false;
            },
            //点击弹层
            hideAlert:function(){
                this.isAlert = false;
            },
            sendCode:function(){
                if(this.flag){
                    if(this.phone == '' || !(/^1[34578]\d{9}$/.test(this.phone))){
                        this.isAlert = true;
                        this.data = "请输入有效电话号";
                    }else{
                        var time = 60;
                        var _this = this;
                        //发送验证码
                        axios.get('welcome/send_phone_code', {
                            params: {
                                phone:_this.phone,
                                tempId:'SMS_60795161'
                            }
                        }).then(function (res) {
                            var result = res.data;
                            if(result == 'success'){
                                _this.flag = false;
                                _this.backColor = '#ccc';
                            }
                        });
                        var timer = setInterval(function(){
                            time--;
                            _this.phoneMsg = "重发("+ time +")";
                            if(time == 0){
                                clearInterval(timer);
                                _this.flag = true;
                                _this.phoneMsg = "获取验证码";
                                _this.backColor = '';
                            }
                        },1000);
                    }
                }
            }
        }
    });
    /*点击验证码图片  换一张*/
    var $captchaImg = $('.captcha');

    function load_captcha() {
        $captchaImg.html('');
        $captchaImg.load("<?php echo site_url('welcome/show_captcha')?>")
    }

    $captchaImg.on('click', function () {
        load_captcha()
    });
</script>
</body>
</html>