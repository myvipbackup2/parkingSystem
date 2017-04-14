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
    <title>登录</title>
    <base href="<?php echo site_url(); ?>">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/mint-ui.min.css">
    <script src="js/rem.js"></script>
</head>
<body>
<div id="header">
    <a class="back" id="leftTopBtn" href="javascript:goBack()">&lt;&nbsp;悦居</a>
    <div class="title">
        登录
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
<!--        <form action="welcome/login" method="post">-->
            <div class="login login-way">
                <h4>登录方式</h4>
                <div class="login-box clearfix">
                    <input class="login-btn tab0 fl sel" type="button" value="短信登录">
                    <input class="login-btn tab1 fr" type="button" value="帐号登录">
                </div>
            </div>
            <div class="tab">
                <div class="tab0">
                    <div class="login login-phone clearfix">
                        <h4>手机号码:</h4>
                        <input class="login-input login-phone-num fl" type="number" placeholder="请输入手机号码..." v-model="phone">
                    </div>
                    <div class="login login-phone-code">
                        <h4>手机验证码:</h4>
                        <div class="login-box clearfix">
                            <input class="login-input login-phone-code-num fl" type="text" placeholder="请输入手机验证码..." v-model="phoneCode">
                            <input class="login-btn login-phone-code-btn fr" :style="{background:backColor}" type="button" v-model="phoneMsg" @click="sendCode">
                        </div>
                    </div>
                    <div class="login login-code">
                        <h4>验证码:</h4>
                        <div class="login-box clearfix">
                            <input class="login-input login-phone-code-num fl" type="text" placeholder="请输入验证码..." v-model="captcha">
                            <a href="javascript:;" style="border: none;border-radius: 0" class="captcha login-btn login-phone-code-btn login-code-img fr" title="看不清？换一张！">
                                <?php echo $image; ?>
                            </a>
                        </div>
                    </div>
                    <div class="login-submit">
                        <input type="submit" value="登录" @click="phoneLogin">
                    </div>
                </div>
                <div class="tab1 hide">
                    <div class="login login-phone clearfix">
                        <h4>帐号:</h4>
<!--                        用户名为6-12位数字或字母-->
                        <input name="username" class="login-input login-phone-num fl" v-model="username" type="text" placeholder="请输入帐号...">
                    </div>
                    <div class="login login-phone-code">
                        <h4>密码:</h4>
                        <div class="login-box clearfix">
                            <input name="password" class="login-input login-phone-num fl" type="password"
                                   placeholder="请输入登录密码..." v-model="password">
                        </div>
                    </div>
                    <div class="login login-code">
                        <h4>验证码:</h4>
                        <div class="login-box clearfix">
                            <input name="captchaVal" class="login-input login-phone-code-num fl" type="text"
                                   placeholder="请输入验证码..." v-model="captchaVal">
                            <a href="javascript:;" style="border: none;border-radius: 0" class="captcha login-btn login-phone-code-btn login-code-img fr" title="看不清？换一张！">
                                <?php echo $image; ?>
                            </a>
                        </div>
                    </div>
                    <div class="login-submit">
                        <input type="submit" @click="login()" value="登录">
                    </div>
                </div>

            </div>
            <div class="login login-other-way">
                <h4>第三方登录</h4>
                <div class="clearfix">
                    <div class="login-wechat fl">
                        <div class="img">
                            <img src="images/login-wechat.png" alt="">
                        </div>
                        <span>微信登录</span>
                    </div>
                    <div class="login-qq fl">
                        <div class="img">
                            <img src="images/login-qq.png" alt="">
                        </div>
                        <span>QQ登录</span>
                    </div>
                </div>
            </div>

<!--        </form>-->
    </div>
    <a class="register" href="welcome/registerView">没有帐号？马上注册!</a>
    <div class="mint-msgbox-wrapper" style="position: absolute; z-index: 1001;display: none;" v-show="isAlert">
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

<!-- 引入组件库 -->
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
            data:'',
            flag:true,
            phone:'',
            phoneCode:'',
            captcha:'',
            phoneMsg:'获取验证码',
            backColor:''
        },
        methods: {
            //登录
            login:function(){
                var _this = this;

                if(this.username == '' || !(/^[0-9A-Za-z]{6,12}$/.test(this.username))){
                    this.isAlert = true;
                    this.data = "用户名为6-16位数字或字母";
                }else if(this.password == '' || !(/^[0-9A-Za-z]{6,12}$/.test(this.password))){
                    this.isAlert = true;
                    this.data = "密码为6-16位数字或字母";
                }else {
                    axios.get('welcome/login', {
                        params: {
                            username: _this.username,
                            password: _this.password,
                            captchaVal: _this.captchaVal
                        }
                    }).then(function (res) {
                        if (res.data == 'success') {
                            window.location.href = decodeURIComponent(_this.getCookie('prev_url'));
                        } else {
                            _this.isAlert = true;
                            _this.data = res.data;
                        }
                    });
                }
                return false;
            },
            //点击弹层
            hideAlert:function(){
                this.isAlert = false;
            },
            phoneLogin:function(){
                var phoneCode = this.phoneCode;
                var captcha = this.captcha;
                var phone = this.phone;
                var _this = this;
                if(this.phone == '' || !(/^1[34578]\d{9}$/.test(this.phone))){
                    this.isAlert = true;
                    this.data = "请输入有效电话号";
                }else{
                    axios.get('user/login_phone', {
                        params: {
                            phone:phone,
                            phoneCode:phoneCode,
                            captcha:captcha
                        }
                    }).then(function(res){
                        var result = res.data;
                        if(result == 'success'){
                            window.location.href =decodeURIComponent(_this.getCookie('prev_url')) ;
                        }else if(result == 'captchaError'){
                            _this.isAlert = true;
                            _this.data = "验证码错误";
                        }else if(result == 'phoneError'){
                            _this.isAlert = true;
                            _this.data = "手机验证码错误";
                        }

                    });
                }

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
            },
            getCookie:function(key){
                var str = document.cookie; //"age=18; name=xxx"

                var arr = str.split('; ');  //['age=18','name=xxx'];

                for(var i=0; i<arr.length; i++){
                    var arr1 = arr[i].split('=');  //['age','18']   ['name','xxx']
                    if(arr1[0] == key){
                        return arr1[1];
                    }
                }
            }
        }
    });
    $(function () {
        $('.login-box .login-btn.tab0').on('click', function () {
            $(this).addClass('sel').siblings().removeClass('sel');
            $('.tab .tab0').removeClass('hide').siblings().addClass('hide');
        });
        $('.login-box .login-btn.tab1').on('click', function () {
            $(this).addClass('sel').siblings().removeClass('sel');
            $('.tab .tab1').removeClass('hide').siblings().addClass('hide');
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
        $('.login-wechat').on('click',function(){
            window.location = "member/wechat_login";
        });

        $('.login-qq').on('click',function(){
            window.location = "member/qq_login";
        });
    });


</script>
</body>
</html>