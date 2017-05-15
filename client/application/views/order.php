<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>我的订单</title>
    <base href="<?php echo site_url(); ?>"/>
    <script src="js/rem.js"></script>
    <link rel="stylesheet" href="css/reset.css"/>
    <link rel="stylesheet" href="css/collect.css"/>
    <link rel="stylesheet" href="css/mint-ui.min.css">

</head>
<body>
<div id="header">
    <a class="back" id="leftTopBtn" href="javascript:goBack()">&lt;&nbsp;随心停</a>
    <div class="title">
        我的订单
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
<div id="order-container">
    <div class="tab-bar">
        <a href="javascript:;" :class="{'item':show,'current':showSpan}" @click="getparks('un_order')"><span>未完成</span></a>
        <a href="javascript:;" :class="{'item':show,'current':!showSpan}"
           @click="getparks('order')"><span>已完成</span></a>
    </div>
    <div class="pro-container">
        <div class="pro-item" v-for='(order,index) in orderList'>
            <div class="clearfix">
                <div class="fl p-img">
                    <a class="pro-box clearfix" href="#">
                        <img :src="'<?php echo ADMINPATH ?>'+order.imgs[0].img_thumb_src" alt=""/>
                    </a>
                </div>
                <div class="fr p-info" style="text-align: center;">
                    <div class="p-btns-box" v-show="showSpan" style="text-align: center;">
                        <a href="javascript:;" class="p-btns p-cancel cancel_order"
                           @click="delOrder(order.order_id,index)"
                           v-show="!isPay(order.status)&&!isRefund(order.status)">取消订单</a>
                        <a class="p-btns p-update" :href="'welcome/confirmorder?order_id='+order.order_id"
                           v-show="!isPay(order.status)&&!isRefund(order.status)">去支付</a>
                        <a class="p-btns p-update" v-show="isPay(order.status)&&!isRefund(order.status)"
                           :href="'order/apply_refund?order_no='+order.order_no">申请退款</a>
                        <a class="p-btns p-update" v-show="isRefund(order.status)"
                           style="background: #eee;color: #ccc;">正在退款</a>
                    </div>
                    <div class="p-btns-box" v-show="!showSpan">
                        <a class="p-btns p-cancel"
                           :href="'welcome/add_comment?orderId='+order.order_id+'&parkId='+order.park_id"
                           v-show="order.comment">评论</a>
                        <a class="p-btns p-cancel" href="javascript:;" v-show="!order.comment">已评论</a>
                        <a class="p-btns p-update" :href="'order/order_detail?orderId='+order.order_id">查看详情</a>
                    </div>
                </div>
            </div>
            <div class="pro-date">
                停车时间：{{order.start_time}} - {{order.end_time}}
            </div>
        </div>
    </div>
    <!--confirm弹框-->
    <div v-show="isShow">
        <div class="mint-msgbox-wrapper" style="position: absolute; z-index: 1011;">
            <div class="mint-msgbox">
                <div class="mint-msgbox-header">
                    <div class="mint-msgbox-title">提示</div>
                </div>
                <div class="mint-msgbox-content">
                    <div class="mint-msgbox-message">确定取消订单?</div>
                    <div class="mint-msgbox-input" style="display: none;"><input placeholder="" type="text">
                        <div class="mint-msgbox-errormsg" style="visibility: hidden;"></div>
                    </div>
                </div>
                <div class="mint-msgbox-btns">
                    <button class="mint-msgbox-btn mint-msgbox-cancel " @click="isConfirm(false)">取消</button>
                    <button class="mint-msgbox-btn mint-msgbox-confirm " @click="isConfirm(true)">确定</button>
                </div>
            </div>
        </div>
        <div class="v-modal" style="z-index: 1010;"></div>
    </div>
</div>
<!-- 引入组件库 -->
<script src="js/vue.js"></script>
<script src="js/axios.min.js"></script>
<script src="js/mintUI.min.js"></script>
<script src="js/zepto.js"></script>
<script src="js/header.js"></script>
<script>
    var vm = new Vue({
        el: '#order-container',
        data: {
            show: true,
            showSpan: true,
            orderList: [],
            isShow: false,
            orderId: '',
            index: ''
        },
        methods: {
            loadData: function (isHot) {
                var _this = this;
                axios.get('user/loadOrder', {
                    params: {
                        orderType: isHot
                    }
                }).then(function (res) {
                    var result = res.data;
                    _this.orderList = result.data;
                    _this.orderList = _this.orderList.reverse();//订单倒序
                });
            },
            getparks: function (isHot) {
                if (isHot == 'order') {    //un_order    order
                    this.showSpan = false;
                } else {
                    this.showSpan = true;
                }
                this.loadData(isHot);
            },
            delOrder: function (orderId, index) {
                this.orderId = orderId;
                this.index = index;
                this.isShow = true;
            },
            isConfirm: function (isGo) {
                var _this = this;
                if (isGo) {
                    axios.get('Welcome/delete_order', {
                        params: {
                            orderId: _this.orderId
                        }
                    }).then(function (res) {
                        var result = res.data;
                        if (result == 'success') {
                            _this.orderList.splice(_this.index, 1);
                            _this.isShow = false;
                        } else {
                        }
                    });
                } else {
                    _this.isShow = false;
                }
            },
            isPay: function (order_status) {
                if (order_status == '已支付') {
                    return true;
                } else {
                    return false;
                }
            },
            isRefund: function (order_status) {
                if (order_status == '申请退款') {
                    return true;
                } else {
                    return false;
                }
            }
        }
    });

    vm.getparks('un_order');
</script>
</body>
</html>

