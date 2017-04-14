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
    <title>注册</title>
    <base href="<?php echo site_url(); ?>">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/register.css">
    <link rel="stylesheet" href="css/mint-ui.min.css">
    <script src="js/rem.js"></script>
</head>
<body>
<div id="header">
    <a class="back" id="leftTopBtn" href="javascript:goBack()">&lt;&nbsp;悦居</a>
    <div class="title">
        欢迎注册
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
<div id="app">
    <div class="form">
<!--        <form action="welcome/regist">-->
            <div class="register register-phone clearfix">
                <h4>请输入用户名:</h4>
                <input class="register-input register-phone-num fl" type="text" name="username" placeholder="用户名..." v-model="username">
            </div>
            <div class="register register-phone clearfix">
                <h4>请输入密码:</h4>
                <input class="register-input register-phone-num fl" type="password" name="password" placeholder="请输入密码..." v-model="password">
            </div>
            <div class="register register-phone clearfix">
                <h4>手机号码:</h4>
                <input class="register-input register-phone-num fl" type="number" name="phoneNum" placeholder="请输入手机号码..." v-model="telephone">
            </div>
            <div class="register register-phone-code">
                <h4>手机验证码:</h4>
                <div class="register-box clearfix">
                    <input class="register-input register-phone-code-num fl" type="text" placeholder="请输入手机验证码..." v-model="telCaptcha">
                    <input class="register-btn register-phone-code-btn fr" type="button" v-model="phoneMsg" @click="sendCode">
                </div>
            </div>
            <div class="register register-code">
                <h4>验证码:</h4>
                <div class="register-box clearfix">
                    <input class="register-input register-phone-code-num fl" type="text" name="captchaReg" placeholder="请输入验证码..." v-model="captchaVal">
                    <a href="javascript:;" style="border: none;border-radius: 0" class="captcha register-btn register-phone-code-btn register-code-img fr" title="看不清？换一张！">
                        <?php echo $image; ?>
                    </a>
                </div>
            </div>
            <div class="register register-other-way">
                <h4>第三方登录</h4>
                <div class="clearfix">
                    <div class="register-wechat fl">
                        <a href="#">
                            <div class="img">
                                <img src="images/login-wechat.png" alt="">
                            </div>
                            <span>微信登录</span>
                        </a>
                    </div>
                    <div class="register-qq fl">
                        <div class="img">
                            <img src="images/login-qq.png" alt="">
                        </div>
                        <span>QQ登录</span>
                    </div>
                </div>
            </div>
            <div class="register-submit">
                <input type="submit" value="注册" @click="register()">
            </div>
<!--        </form>-->
    </div>
    <a class="login" href="welcome/loginView">已有帐号？马上登录!</a>
    <div v-show="isAlert" style="display: none;">
        <div class="mint-msgbox-wrapper" style="position: absolute; z-index: 1001;" >
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
        <div class="v-modal" style="z-index: 1000;"></div>
    </div>
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
            username:'',
            password:'',
            captchaVal:'',
            telephone:'',
            telCaptcha:'',
            data:'',
            flag:true,
            phoneMsg:'获取验证码',
            backColor:''
        },
        methods: {
            //注册
            register:function(){
                var _this = this;
                if(this.username == '' || !(/^[0-9A-Za-z]{6,12}$/.test(this.username))){
                    this.isAlert = true;
                    this.data = "用户名为6-16位数字或字母";
                }else if(this.password == '' || !(/^[0-9A-Za-z]{6,12}$/.test(this.password))){
                    this.isAlert = true;
                    this.data = "密码为6-16位数字或字母";
                }else if(this.telephone == '' || !(/^1[34578]\d{9}$/.test(this.telephone))) {
                    this.isAlert = true;
                    this.data = "请输入有效电话号";
                }else{
                    axios.get('welcome/check_username', {
                        params: {
                            username: _this.username
                        }
                    }).then(function (res) {
                        if (res.data == "check_username success") {
                            axios.get('welcome/regist', {
                                params: {
                                    username: _this.username,
                                    password: _this.password,
                                    phoneNum: _this.telephone,
                                    telCaptcha: _this.telCaptcha,
                                    captchaVal: _this.captchaVal
                                }
                            }).then(function (res) {
                                if (res.data == 'success') {
                                    window.location.href = "welcome";
                                } else {
                                    _this.isAlert = true;
                                    _this.data = res.data;
                                }
                            });
                        }
                    });
                }
                return false;
            },
            //点击弹层
            hideAlert:function(){
                this.isAlert = false;
            },
            sendCode:function(){
                if(this.flag){
                    if(this.telephone == '' || !(/^1[34578]\d{9}$/.test(this.telephone))){
                        this.isAlert = true;
                        this.data = "请输入有效电话号";
                    }else{
                        var time = 60;
                        var _this = this;
                        //发送验证码
                        axios.get('welcome/send_phone_code', {
                            params: {
                                phone:_this.telephone,
                                tempId:'SMS_60795165'
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