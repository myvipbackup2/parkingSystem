<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>我的随心停</title>
    <base href="<?php echo site_url(); ?>"/>
    <script src="js/rem.js"></script>
    <link rel="stylesheet" href="css/reset.css"/>
    <link rel="stylesheet" href="css/mint-ui.min.css">
    <link rel="stylesheet" href="css/userInfo.css">

</head>
<body>
<div id="header">
    <a class="back" id="leftTopBtn" href="javascript:goBack()">&lt;&nbsp;随心停</a>
    <div class="title">
        我的随心停
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
                <a href="user" data-stat-label="我的随心停">
                    我的随心停
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
<div id="user">
    <div id="page_user_menu">
        <div id="user_data">
            <a href="Welcome/personalInfo">
                <img src="<?php echo $userinfo->portrait ?>">
                <div class="title">
                    <h2><?php echo $userinfo->username ?></h2>
                    <p>
                        <label id="lblCustomerLevel">会员</label>
                    </p>
                </div>
            </a>
        </div>
    </div>
    <div class="sec-content nav">
        <div class="list">
            <a href="welcome/order">订单</a>
            <a href="welcome/comment">评论</a>
        </div>
    </div>
    <div class="sec-content nav">
        <div class="list">
            <a href="welcome/collection_manage">收藏</a>
            <a href="welcome/message">消息</a>
        </div>
    </div>
    <div class="sec-content nav">
        <div class="logout">
            <a href="javascript:;" @click="logout">退出</a>
        </div>
    </div>
    <!--confirm弹框-->
    <div v-show="isConfirm" style="display: none">
        <div class="mint-msgbox-wrapper" style="position: absolute; z-index: 1011;">
            <div class="mint-msgbox">
                <div class="mint-msgbox-header">
                    <div class="mint-msgbox-title">提示</div>
                </div>
                <div class="mint-msgbox-content">
                    <div class="mint-msgbox-message">确定退出操作?</div>
                    <div class="mint-msgbox-input" style="display: none;"><input placeholder="" type="text">
                        <div class="mint-msgbox-errormsg" style="visibility: hidden;"></div>
                    </div>
                </div>
                <div class="mint-msgbox-btns">
                    <button class="mint-msgbox-btn mint-msgbox-cancel " @click="cancel()">取消</button>
                    <button class="mint-msgbox-btn mint-msgbox-confirm " @click="sure()">确定</button>
                </div>
            </div>
        </div>
        <div class="v-modal" style="z-index: 1010;"></div>
    </div>
</div>
<!-- 引入组件库 -->
<script src="js/vue.min.js"></script>
<script src="js/mintUI.min.js"></script>
<script src="js/zepto.js"></script>
<script src="js/header.js"></script>

<script>
    var vm = new Vue({
        el: '#user',
        data: {
            isConfirm: false
        },
        methods: {
            logout: function () {
                this.isConfirm = true;
            },
            cancel: function () {
                this.isConfirm = false;
            },
            sure: function () {
                this.isAlert = true;
                window.location = "user/logout";
            }
        }
    });
</script>
</body>
</html>