<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>车库中心</title>
    <base href="<?php echo site_url() ?>">
    <script src="js/rem.js"></script>
    <link rel="stylesheet" href="css/reset.css"/>
    <link rel="stylesheet" href="css/house_center.css"/>

</head>
<body>
<div id="header">
    <a class="back" id="leftTopBtn" href="javascript:goBack()">&lt;&nbsp;随心停</a>
    <div class="title">
        车库中心
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
                <a href="user"  data-stat-label="我的随心停">
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
<div class="container">
    <div class="search">
        <div class="fl search-area">
            区域
        </div>
        <ul class="area_search_list">
            <li v-model='region'>不限</li>
            <li v-model='region'>香坊区</li>
            <li v-model='region'>南岗区</li>
            <li v-model='region'>动力区</li>
            <li v-model='region'>道里区</li>
            <li v-model='region'>道外区</li>
            <li v-model='region'>呼兰区</li>
            <li v-model='region'>双城区</li>
            <li v-model='region'>江北区</li>
        </ul>
        <div class="fl search-box">
            <input class="fl search-box-ipt" placeholder="搜索车库..." type="text" v-model="content"/>
            <span class="fl search-box-btn" @click="loadData()"></span>
        </div>
    </div>
    <div class="type-box">
        <ul>
            <li>
                <span v-html="plotName">小区</span>
                <i class="t-icons"></i>
                <ul class="search_list">
                    <li @click="changePlot(null,'不限')">
                        不限
                    </li>
                    <li v-for="plot in plots" @click="changePlot(plot.plot_id,plot.plot_name)">
                        {{plot.plot_name}}
                    </li>
                </ul>
            </li>
            <li>
                <span v-html="isSale">是否可售</span>
                <i class="t-icons"></i>
                <ul class="search_list">
                    <li @click="changeSale('不限')">不限</li>
                    <li @click="changeSale('不可售')">不可售</li>
                    <li @click="changeSale('可售')">可售</li>
                </ul>
            </li>
            <li>
                <span v-html="price">价钱</span>
                <i class="t-icons"></i>
                <ul class="search_list">
                    <li @click="changePrice(0,999999999,'不限')">不限</li>
                    <li @click="changePrice(0,200,'0-200')">0-200</li>
                    <li @click="changePrice(201,300,'201-300')">201-300</li>
                    <li @click="changePrice(301,500,'301-500')">301-500</li>
                    <li @click="changePrice(500,999999999,'500以上')">500以上</li>
                </ul>
            </li>
            <li>
                <span v-html="houseStyle">车库</span>
                <i class="t-icons"></i>
                <ul class="search_list">
                    <li @click="changeHouseStyle(null,'不限')">不限</li>
                    <li @click="changeHouseStyle(1,'一居室')">一居室</li>
                    <li @click="changeHouseStyle(2,'两居室')">两居室</li>
                    <li @click="changeHouseStyle(3,'三居室')">三居室</li>
                    <li @click="changeHouseStyle(4,'四居以上')">四居以上</li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="hot-type">
        <a class="hot-item" :class="{'hot-active':isShow}" href="javascript:;" @click="loadData('hot')">热门推荐</a>
        <a class="hot-item" :class="{'hot-active':!isShow}" href="javascript:;" @click="loadData()">全部</a>
    </div>
    <div class="content">
        <div class="c-item-box">
            <div class="c-item" v-for="house in houses">
                <a :href="'House/detail/'+house.house_id">
                    <div class="p-img">
                        <img :src="'<?php echo ADMINPATH?>'+house.img_thumb_src" alt=""/>
                    </div>
                    <div class="p-info">
                        <div class="fl p-title">{{house.title}}</div>
                        <div class="fr p-address">￥{{house.price}}</div>
                        <div class="p-detail">{{house.street}}</div>
                    </div>
                </a>
            </div>
        </div>

    </div>

</div>

<script src="js/jquery.min.js"></script>
<script src="js/vue.min.js"></script>
<script src="js/axios.min.js"></script>
<script src="js/zepto.js"></script>
<script src="js/header.js"></script>
<script>
    var houseData = <?php if(isset($data)){echo $data;}else{echo '[];';}?>;
    var houseCenterVM = new Vue({
        el:".container",
        data:{
            isShow:true,
            plots:<?php if(isset($plots)){echo $plots;}else{echo '[]';}?>,
            houses:[],
            content:'<?php if(isset($content)){echo "$content";}else{echo '';}?>',
            region:'区域',
            price:"价格",
            minPrice:null,
            maxPrice:null,
            houseStyle:"户型",
            isSale:"是否可售",
            plotId:null,
            plotName:"小区",
            redroom:null
        },
        mounted: function () {
            var _this = this;
            this.$nextTick(function () {
                if(houseData.length > 0){
                    _this.houses = houseData;
                }else{
                    houseCenterVM.loadData("hot");
                }
            });
        },
        methods:{
            loadData: function (isHot) {
                if(isHot == 'hot'){
                    this.isShow = true;
                }else{
                    this.isShow = false;
                }
                var _this = this;
                axios.get('house/get_houses', {
                    params: {
                        region:_this.region,
                        content:_this.content,
                        minPrice:_this.minPrice,
                        maxPrice:_this.maxPrice,
                        plotId:_this.plotId,
                        redroom:_this.redroom,
                        isSale:_this.isSale,
                        isHot: isHot?isHot:'all'
                    }
                }).then(function (res) {
                    var result = res.data;
                    _this.houses = result.data;
                });
            },
            changePlot:function(plot_id,plot_name){
                this.plotId = plot_id;
                this.plotName = plot_name;
                this.loadData();
            },
            changeSale:function(issale){
                this.isSale = issale;
                this.loadData();
            },
            changePrice:function(minPrice,maxPrice,price){
                this.minPrice = minPrice;
                this.maxPrice = maxPrice;
                this.price = price;
                this.loadData();
            },
            changeHouseStyle:function(redroom,houseStyle){
                this.houseStyle = houseStyle;
                this.redroom = redroom;
                this.loadData();
            }
        }
    });

</script>
<script>
    $(function () {
        //热门推荐选项卡
//        $('.hot-type').on('click', 'a', function () {
//            $(this).addClass('hot-active').siblings().removeClass('hot-active');
//        });
        //下拉菜单
        $('.type-box>ul>li').on('click', function (e) {
            $(this).find('.search_list').slideToggle(300).end().siblings().find('.search_list').slideUp(300);
            e.stopPropagation();
        });
        //监听点击收起
        $('body').on('click', function () {
            $('.search_list').slideUp(300);
            $('.area_search_list').slideUp(300);
        });
        //监听滚动收起
        $(window).on('scroll', function () {
            $('.search_list').slideUp(300);
        });
        $('.search-area').on('click',function(e){
            $('.area_search_list').show();
            e.stopPropagation();

        });
        $('.area_search_list li').on('click',function(){
            $('.search-area').html($(this).html());
            houseCenterVM.region = $(this).html();
            $('.area_search_list').hide();
        });

    });
</script>
</body>
</html>